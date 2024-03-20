@extends('layouts.app')
@section('title')
Atte - 登録画面
@endsection
<link href="{{ asset('css/register.css') }}" rel="stylesheet">
@section('content')
<div class="register__container">
    <div class="register__form">
        <h2>会員登録</h2>
        <form action="{{route('register')}}" method="POST">
            @csrf
            <div class="register__form--group">
                <input type="text" name="name" value="{{ old('name') }}" class="register__form--group-item" placeholder="名前" required>
            </div>
            @if ($errors->has('name'))
            <span class="error">{{ $errors->first('name') }}</span>
            @endif
            <div class="register__form--group">
                <input type="email" name="email" value="{{ old('email') }}" class="register__form--group-item" placeholder="メールアドレス" required>
            </div>
            @if ($errors->has('email'))
            <span class="error">{{ $errors->first('email') }}</span>
            @endif
            <div class="register__form--group">
                <input type="password" name="password" class="register__form--group-item" placeholder="パスワード" required>
            </div>
            @if ($errors->has('password'))
            <span class="error">{{ $errors->first('password') }}</span>
            @endif
            <div class="register__form--group">
                <input type="password" name="password_confirmation" class="register__form--group-item" placeholder="確認用パスワード" required>
            </div>
            @if ($errors->has('password_confirmation'))
            <span class="error">{{ $errors->first('password_confirmation') }}</span>
            @endif
            <div class="register__form--group">
                <button type="submit" class="register__form--group-button">会員登録</button>
            </div>
        </form>
        <p>アカウントをお持ちの方はこちらから</p>
        <a href="/login" class="login__create--button">ログイン</a>
    </div>
</div>
@endsection