@extends('layouts.app')
@section('title')
Atte - 打刻画面
@endsection
<link href="{{ asset('css/stamp.css') }}" rel="stylesheet">
@section('header-nav')
<nav class="header__nav">
    <ul class="header__nav--list">
        <li class="nav--list__item"><a href="/register">ホーム</a></li>
        <li class="nav--list__item"><a href="#">日付一覧</a></li>
        @if(Auth::check())
        <form action="/logout" method="post">
            @csrf
            <button type=" submit" class="nav--list__item">ログアウト</button>
        </form>
        @endif
    </ul>
</nav>
@endsection
@section('content')
<main class=" stamp__container">
    <h2>福岡太郎さんお疲れ様です！</h2>
    <div class="stamp__cards">
        <div class="stamp-card">
            <!-- 打刻ボタンのアクションは適切に設定する -->
            <button class="stamp-button">勤務開始</button>
        </div>
        <div class="stamp-card">
            <button class="stamp-button">勤務終了</button>
        </div>
        <div class="stamp-card">
            <button class="stamp-button">休憩開始</button>
        </div>
        <div class="stamp-card">
            <button class="stamp-button">休憩終了</button>
        </div>
    </div>
</main>
@endsection