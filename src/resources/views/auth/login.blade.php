@extends('layouts.app')
@section('title')
Atte - ログイン画面
@endsection
<link href="{{ asset('css/login.css') }}" rel="stylesheet">
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif
@section('content')
<div class="login__container">
    <div class="login__form">
        <h2>ログイン</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="login__form--group">
                <input type="email" class="login__form--group-item" name="email" value="{{ old('email') }}" placeholder="メールアドレス" required>
            </div>
            @if ($errors->has('email'))
            <span class="error">{{ $errors->first('email') }}</span>
            @endif
            <div class="login__form--group">
                <input type="password" class="login__form--group-item" name="password" placeholder="パスワード" required>
            </div>
            @if ($errors->has('password'))
            <span class="error">{{ $errors->first('password') }}</span>
            @endif
            <div class="login__form--group">
                <button type="submit" class="login__form--group-button">ログイン</button>
            </div>
        </form>
        <p>アカウントをお持ちでない方はこちらから</p>
        <a href="/register" class="register__create--button">会員登録</a>
    </div>
</div>
@endsection