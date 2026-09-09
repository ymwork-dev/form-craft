<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DemoLoginTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function ログイン画面にかんたんログインボタンが表示される(): void
    {
        $response = $this->get('/login');

        $response->assertOk();
        $response->assertSee('デモ用アカウントでログイン');
    }

    #[Test]
    public function かんたんログインでパスワードなしでログインし管理画面に遷移する(): void
    {
        $user = User::factory()->create([
            'email' => User::DEMO_EMAIL,
            'password' => Hash::make('demo1234'),
        ]);

        $response = $this->post('/demo-login');

        $response->assertRedirect('/admin');
        $this->assertAuthenticatedAs($user);
    }

    #[Test]
    public function デモ用アカウントが存在しなければログイン画面に戻る(): void
    {
        $response = $this->post('/demo-login');

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }
}
