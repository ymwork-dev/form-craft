<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function ゲストはログイン画面にリダイレクトされる(): void
    {
        $response = $this->get('/admin');

        $response->assertRedirect('/login');
    }

    #[Test]
    public function 認証済みユーザーは管理画面を閲覧できる(): void
    {
        $user = User::factory()->create();
        $category = Category::create(['content' => 'サービスについて']);
        Contact::factory()->create(['category_id' => $category->id, 'first_name' => '太郎', 'last_name' => '山田']);

        $response = $this->actingAs($user)->get('/admin');

        $response->assertOk();
        $response->assertSee('山田');
    }

    #[Test]
    public function キーワードで検索できる(): void
    {
        $user = User::factory()->create();
        $category = Category::create(['content' => 'サービスについて']);
        Contact::factory()->create([
            'category_id' => $category->id,
            'first_name' => '太郎',
            'last_name' => '山田',
            'email' => 'taro@example.com',
            'address' => '東京都渋谷区千駄ヶ谷1-2-3',
            'building' => 'テストマンション101',
            'detail' => '山田です。テストのお問い合わせ内容です。',
        ]);
        Contact::factory()->create([
            'category_id' => $category->id,
            'first_name' => '花子',
            'last_name' => '鈴木',
            'email' => 'hanako@example.com',
            'address' => '大阪府大阪市北区梅田1-2-3',
            'building' => 'テストビル202',
            'detail' => '鈴木です。テストのお問い合わせ内容です。',
        ]);

        $response = $this->actingAs($user)->get('/admin/search?keyword=山田');

        $response->assertOk();
        $response->assertSee('山田');
        $response->assertDontSee('鈴木');
    }

    #[Test]
    public function 認証済みユーザーはお問い合わせを削除できる(): void
    {
        $user = User::factory()->create();
        $category = Category::create(['content' => 'サービスについて']);
        $contact = Contact::factory()->create(['category_id' => $category->id]);

        $response = $this->actingAs($user)->post('/delete', ['id' => $contact->id]);

        $response->assertRedirect();
        $this->assertDatabaseMissing('contacts', ['id' => $contact->id]);
    }

    #[Test]
    public function 未認証ユーザーは削除できない(): void
    {
        $category = Category::create(['content' => 'サービスについて']);
        $contact = Contact::factory()->create(['category_id' => $category->id]);

        $response = $this->post('/delete', ['id' => $contact->id]);

        $response->assertRedirect('/login');
        $this->assertDatabaseHas('contacts', ['id' => $contact->id]);
    }

    #[Test]
    public function 認証済みユーザーはCSVをエクスポートできる(): void
    {
        $user = User::factory()->create();
        $category = Category::create(['content' => 'サービスについて']);
        Contact::factory()->create(['category_id' => $category->id]);

        $response = $this->actingAs($user)->get('/export');

        $response->assertOk();
        $response->assertHeader('Content-Type', 'text/csv; charset=UTF-8');
    }
}
