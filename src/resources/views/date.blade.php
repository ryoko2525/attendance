@extends('layouts.app')
@section('title')
Atte - 勤務打刻
@endsection
<link href="{{ asset('css/date.css') }}" rel="stylesheet">
@section('header-nav')
@include('components.header-nav', ['isAuthenticated' => Auth::check()])
@endsection
@section('content')

<main class="date-container">
    @include('components.date-navigation', ['date' => $date ?? null])

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