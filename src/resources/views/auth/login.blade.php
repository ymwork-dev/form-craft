@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('header-nav')
<nav>
    <a class="header-nav__button" href="/register">新規登録</a>
</nav>
@endsection

@section('content')
<div class="login-content">
    <div class="login-header">
        <h1>ログイン</h1>
    </div>

    <div class="login-form-inner">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <div class="form-input">
                    <input type="text" name="email" id="email" value="{{ old('email') }}" placeholder="test@example.com">
                </div>
                @error('email')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">パスワード</label>
                <div class="form-input">
                    <input type="password" name="password" id="password" placeholder="fashionably-late1106">
                </div>
                @error('password')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            @error('login_error')
                <p class="error-message">{{ $message }}</p>
            @enderror

            <div class="form-btn">
                <button type="submit" class="btn-login">ログイン</button>
            </div>
        </form>

        <div class="demo-info">
            <p>デモ用アカウント</p>
            <p>Email: demo@example.com</p>
            <p>Password: demo1234</p>
        </div>
    </div>
</div>
@endsection
