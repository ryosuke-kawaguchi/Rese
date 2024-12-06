@extends('layouts.app')

@section('content')
<div class="container">
    <h1>メール認証が必要です</h1>
    <p>登録したメールアドレスに認証用のリンクを送信しました。メールを確認してリンクをクリックしてください。</p>
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit">認証メールを再送信</button>
    </form>
</div>
@endsection