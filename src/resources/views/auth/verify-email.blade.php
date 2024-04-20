@extends('layouts.app')
@section('title')
Atte - メール認証
@endsection
<link href="{{ asset('css/verify.css') }}" rel="stylesheet">
@section('content')
<div class="verify-email__container">
    <h1 class="verify-email__title">新規ユーザー登録のため、メールが送信されました</h1>
    <p class="verify-email__message">ご登録ありがとうございます。メールをご確認の上、リンクをクリックしてログインしてください。</p>
</div>
@endsection