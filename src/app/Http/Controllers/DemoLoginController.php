<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemoLoginController extends Controller
{
    // ログイン画面の「デモ用アカウントでログイン」ボタンから呼ばれる。
    // パスワード入力なしで、あらかじめ用意したデモアカウントとしてログインさせる。
    public function store(Request $request)
    {
        $user = User::where('email', User::DEMO_EMAIL)->first();

        if (! $user) {
            return redirect('/login')->withErrors([
                'email' => 'デモ用アカウントが見つかりませんでした。',
            ]);
        }

        Auth::login($user);
        $request->session()->regenerate();

        // 通常ログインと同じ遷移先(config/fortify.php の home = /admin)
        return redirect()->intended(config('fortify.home'));
    }
}
