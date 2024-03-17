@extends('layouts.app')
@section('title')
    <title>Atte - 登録画面</title>
@endsection
    <title>Atte - 登録画面</title>
    <link href="{{ asset('css/register.css') }}" rel="stylesheet">
@section('content')
    <div class="register__container">
        <div class="register__form">
            <h2>会員登録</h2>
            <form action="" method="POST">
                @csrf
                <div class="register__form--group">
                    <input type="text" name="name" class="register__form--group-item" placeholder="名前" required>
                </div>
                <div class="register__form--group">
                    <input type="email" name="email" class="register__form--group-item" placeholder="メールアドレス" required>
                </div>
                <div class="register__form--group">
                    <input type="password" name="password" class="register__form--group-item" placeholder="パスワード" required>
                </div>
                <div class="register__form--group">
                    <input type="password" name="password_confirmation" class="register__form--group-item" placeholder="確認用パスワード" required>
                </div>
                <div class="register__form--group">
                    <button type="submit" class="register__form--group-button">会員登録</button>
                </div>
            </form>
            <p>アカウントをお持ちの方はこちらから</p>
            <a href="" class="login__create--button">ログイン</a>
        </div>
    </div>
@endsection