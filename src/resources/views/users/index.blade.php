@extends('layouts.app')
@section('title')
Atte - 会員一覧
@endsection
<link href="{{ asset('css/index.css') }}" rel="stylesheet">
@section('header-nav')
@include('components.session-messages')
@include('components.header-nav', ['isAuthenticated' => Auth::check()])
@endsection
@section('content')
<main class="user-index__container">
        <h1 class="user-index__title">会員一覧</h1>
        <table class="user-index__table">
            <thead>
                <tr>
                    <th>名前</th>
                    <th>メールアドレス</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td><a href="{{ route('users.attendance', $user->id) }}">{{ $user->name }}</a></td>
                    <td>{{ $user->email }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
</main>
@endsection