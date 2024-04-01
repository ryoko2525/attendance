@extends('layouts.app')
@section('title')
Atte - 勤務打刻
@endsection
<link href="{{ asset('css/date.css') }}" rel="stylesheet">
@section('header-nav')
@include('components.session-messages')
@include('components.header-nav', ['isAuthenticated' => Auth::check()])
@endsection
@section('content')

<main class="date-container">
    @include('components.date-navigation', ['date' => $date ?? null])
    <h2>{{ $user->name }}さん - 勤怠一覧</h2>
    <table class="work-table">
        <tr>
            <th>勤務日</th>
            <th>勤務開始</th>
            <th>勤務終了</th>
            <th>休憩時間</th>
            <th>勤務時間</th>
        </tr>
        @foreach ($attendances as $attendance)
        <tr>
            <td>{{ $attendance->work_date }}</td>
            <td>{{ $attendance->start_time ? $attendance->start_time->format('H:i:s') : '---' }}</td>
            <td>{{ $attendance->end_time ? $attendance->end_time->format('H:i:s') : '---' }}</td>
            <td>{{ gmdate('H:i:s', $attendance->total_break_time * 60) }}</td> <!-- 休憩時間の合計を表示 -->
            <td>{{ gmdate('H:i:s', $attendance->total_work_time * 3600) }}</td> <!-- 勤務時間の合計を表示 -->
        </tr>
        @endforeach
    </table>
</main>
@endsection