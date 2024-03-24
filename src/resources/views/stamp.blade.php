@extends('layouts.app')
@section('title')
Atte - 打刻画面
@endsection
<link href="{{ asset('css/stamp.css') }}" rel="stylesheet">
@section('header-nav')

<nav class="header__nav">

    <ul class="header__nav--list">
        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <li class="nav--list__item"><a href="/register">ホーム</a></li>
        <li class="nav--list__item"><a href="{{ route('works.day', ['date' => now()->format('Y-m-d')]) }}">日付一覧</a></li>

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
<main class=" stamp__container">
    <h2>{{ Auth::user()->name }} さんお疲れ様です！</h2>

    <div class="stamp__cards">
        {{-- 勤務開始ボタン --}}
        <div class="stamp-card">
            <form action="{{ route('work.start') }}" method="POST" class="{{ !$isWorking && $canPunch ? '' : 'disabled' }}">
                @csrf
                <button type="submit" class="stamp-button" {{ !$isWorking && $canPunch ? '' : 'disabled' }}>勤務開始</button>
            </form>
        </div>

        <div class="stamp-card">
            <form action="{{ route('work.end') }}" method="POST" class="{{ $isWorking && $canPunch ? '' : 'disabled' }}">
                @csrf
                <button type="submit" class="stamp-button" {{ $isWorking && $canPunch ? '' : 'disabled' }}>勤務終了</button>
            </form>
        </div>
        {{-- 休憩開始ボタン --}}
        <div class="stamp-card">
            <form action="{{ route('break.start') }}" method="POST" class="{{ $isWorking && !$isOnBreak && $canPunch ? '' : 'disabled' }}">
                @csrf
                <button type="submit" class="stamp-button" {{ $isWorking && !$isOnBreak && $canPunch ? '' : 'disabled' }}>休憩開始</button>
            </form>
        </div>
        <div class="stamp-card">
            <form action="{{ route('break.end') }}" method="POST" class="{{ $isOnBreak ? '' : 'disabled' }}">
                @csrf
                <button type="submit" class="stamp-button" {{ $isOnBreak ? '' : 'disabled' }}>休憩終了</button>
            </form>
        </div>


    </div>
</main>
@endsection