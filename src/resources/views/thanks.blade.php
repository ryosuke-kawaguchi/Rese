@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css')}}">
@endsection

@section('content')
<div class="thanks">
    <div class="thanks-inner">
        <p class="thanks-message">会員登録ありがとうございます</p>
        <form action="/login" class="thanks-form" method="get">
            <button class="thanks__button">ログインする</button>
        </form>
    </div>
</div>
@endsection