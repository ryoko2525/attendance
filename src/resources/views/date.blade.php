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
    @if(isset($date))
    <div class="date-navigation">
        <a href="{{ route('works.day', ['date' => \Carbon\Carbon::parse($date)->subDay()->format('Y-m-d')]) }}" class="date-nav-button">&#60;</a>
        <span class="current-date">{{ \Carbon\Carbon::parse($date)->format('Y-m-d') }}</span>
        <a href="{{ route('works.day', ['date' => \Carbon\Carbon::parse($date)->addDay()->format('Y-m-d')]) }}" class="date-nav-button">&#62;</a>
    </div>
    @endif
    <table class="work-table">
        <tr>
            <th>名前</th>
            <th>勤務開始</th>
            <th>勤務終了</th>
            <th>休憩時間</th>
            <th>勤務時間</th>
        </tr>
        @foreach ($works as $work)
        <tr>
            <td>{{ $work->user->name }}</td>
            <td>{{ $work->start_time ? $work->start_time->format('H:i:s') : '---' }}</td>
            <td>{{ $work->end_time ? $work->end_time->format('H:i:s') : '---' }}</td>
            <td>{{ gmdate('H:i:s', $work->total_break_duration) }}</td>
            <td>{{ gmdate('H:i:s', $work->work_duration) }}</td>
        </tr>
        @endforeach

    </table>
    <div class="pagination">
        {{ $works->links() }}
    </div>
</main>
@endsection