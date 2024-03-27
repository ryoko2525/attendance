@extends('layouts.app')
@section('title')
Atte - 打刻画面
@endsection
<link href="{{ asset('css/stamp.css') }}" rel="stylesheet">
@section('header-nav')
@include('components.session-messages')
@include('components.header-nav', ['isAuthenticated' => Auth::check()])
@endsection
@section('content')
<main class=" stamp__container">
    <h2>{{ Auth::user()->name }} さんお疲れ様です！</h2>
    <div class="stamp__cards">
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