@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/login.css')}}">
@endsection

@section('content')
<div class="login-form">
    <h2 class="login-form__header">Login</h2>
    <div class="login-form__inner">
        <form action="{{route('login')}}" method="post" class="login-form__form">
            @csrf
            <div class="login-form__group">
                <div class="login-form__field">
                    <i class="material-icons">email</i>
                    <input type="email" class="login-form__input" name="email" id="email" placeholder="Email">
                </div>
                <p class="login-form__error-message">
                    @error('email')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="login-form__group">
                <div class="login-form__field">
                    <i class="material-icons">lock</i>
                    <input type="password" class="login-form__input" name="password" id="password" placeholder="Password">
                </div>
                <p class="login-form__error-message">
                    @error('password')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <input type="submit" class="login-form__btn" value="ログイン">
        </form>
    </div>
</div>
@endsection