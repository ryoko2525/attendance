@extends('layouts.app')
@section('title')
    <title>Atte - ログイン画面</title>
@endsection
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
@section('content')
    <div class="login__container">
        <div class="login__form">
            <h2>ログイン</h2>
            <form action="" method="POST">
                @csrf
                <div class="login__form--group">
                    <input type="email" class="login__form--group-item" name="email" placeholder="メールアドレス" required>
                </div>
                <div class="login__form--group">
                    <input type="password" class="login__form--group-item" name="password" placeholder="パスワード" required>
                </div>
                <div class="login__form--group">
                    <button type="submit" class="login__form--group-button">ログイン</button>
                </div>
            </form>
            <p>アカウントをお持ちでない方はこちらから</p>
            <a href="" class="register__create--button">会員登録</a>
        </div>
    </div>
@endsection