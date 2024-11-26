@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/done.css')}}">
@endsection

@section('content')
<div class="done">
    <div class="done-inner">
        <p class="done-message">ご予約ありがとうございます</p>
        <form action="/" class="done-form" method="get">
            <button class="done__button">戻る</button>
        </form>
    </div>
</div>
@endsection