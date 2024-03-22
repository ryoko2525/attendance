@extends('layouts.app')
@section('title')
Atte - 勤務打刻
@endsection
<link href="{{ asset('css/date.css') }}" rel="stylesheet">
@section('header-nav')
<nav class="header__nav">
    <ul class="header__nav--list">
        <li class="nav--list__item"><a href="/login">ホーム</a></li>
        <li class="nav--list__item"><a href="#">日付一覧</a></li>
        <form action="/logout" method="post">
        @csrf
        @if(Auth::check())
            <button type=" submit" class="nav--list__item">ログアウト</button>
        </form>
        @else
        <p>ログインしていません</p>
        @endif
    </ul>
</nav>
@endsection
@section('content')

<main class="date-container">
    <div class="date-navigation">
        <button class="date-nav-button">&#60;</button>
        <span class="current-date">2021-11-01</span>
        <button class="date-nav-button">&#62;</button>
    </div>
    <table class="work-table">
        <tr>
            <th>名前</th>
            <th>勤務開始</th>
            <th>勤務終了</th>
            <th>休憩時間</th>
            <th>勤務時間</th>
        </tr>
        <!-- 仮のデータを表示、サーバーサイドのデータに置き換える -->
        <tr>
            <td>テスト 太郎</td>
            <td>10:00:00</td>
            <td>20:00:00</td>
            <td>00:30:00</td>
            <td>09:30:00</td>
        </tr>
        <!-- 繰り返し部分 -->
    </table>
    <div class="pagination">
        <!-- 仮のページネーション、実際のデータとリンクに置き換える -->
        <a href="#" class="page-link">&#60;</a>
        <!-- ページ番号を動的に生成 -->
        <a href="#" class="page-link">1</a>
        <!-- 繰り返し部分 -->
        <a href="#" class="page-link">&#62;</a>
    </div>
</main>
@endsection