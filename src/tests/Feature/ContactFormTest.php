<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    protected function validPayload(Category $category): array
    {
        return [
            'first_name' => '太郎',
            'last_name' => '山田',
            'gender' => '1',
            'email' => 'taro@example.com',
            'tel1' => '080',
            'tel2' => '1234',
            'tel3' => '5678',
            'address' => '東京都渋谷区千駄ヶ谷1-2-3',
            'building' => 'テストマンション101',
            'category_id' => $category->id,
            'detail' => 'テストのお問い合わせ内容です。',
        ];
    }

    #[Test]
    public function 入力画面にカテゴリが表示される(): void
    {
        Category::create(['content' => 'サービスについて']);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('サービスについて');
    }

    #[Test]
    public function 正しい入力で確認画面が表示される(): void
    {
        $category = Category::create(['content' => 'サービスについて']);

        $response = $this->post('/confirm', $this->validPayload($category));

        $response->assertOk();
        $response->assertSee('山田');
        $response->assertSee('太郎');
    }

    #[Test]
    public function 必須項目が未入力だとバリデーションエラーになる(): void
    {
        $response = $this->post('/confirm', []);

        $response->assertSessionHasErrors([
            'first_name', 'last_name', 'gender', 'email',
            'tel1', 'tel2', 'tel3', 'address', 'category_id', 'detail',
        ]);
    }

    #[Test]
    public function 登録すると電話番号が結合されて保存される(): void
    {
        $category = Category::create(['content' => 'サービスについて']);

        $response = $this->post('/thanks', $this->validPayload($category));

        $response->assertOk();
        $this->assertDatabaseHas('contacts', [
            'first_name' => '太郎',
            'last_name' => '山田',
            'email' => 'taro@example.com',
            'tel' => '08012345678',
            'category_id' => $category->id,
        ]);
    }

    #[Test]
    public function 修正で戻ると登録されずトップに戻る(): void
    {
        $category = Category::create(['content' => 'サービスについて']);

        $response = $this->post('/thanks', array_merge(
            $this->validPayload($category),
            ['back' => 'true']
        ));

        $response->assertRedirect('/');
        $this->assertDatabaseCount('contacts', 0);
    }
}
