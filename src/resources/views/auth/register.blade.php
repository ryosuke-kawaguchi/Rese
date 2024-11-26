@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css')}}">
@endsection

@section('content')
<div class="register-form">
    <p class="register-form__header">Registration</p>
    <div class="register-form__inner">
        <form action="{{route('register')}}" method="post" class="register-form__form">
            @csrf
            <div class="register-form__group">
                <div class="register-form__field">
                    <i class="material-icons">person</i>
                    <input type="text" class="register-form__input" name="name" id="name" placeholder="Username">
                </div>
                <p class="register-form__error-message">
                    @error('name')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="register-form__group">
                <div class="register-form__field">
                    <i class="material-icons">email</i>
                    <input type="email" class="register-form__input" name="email" id="email" placeholder="Email">
                </div>
                <p class="register-form__error-message">
                    @error('email')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="register-form__group">
                <div class="register-form__field">
                    <i class="material-icons">lock</i>
                    <input type="password" class="register-form__input" name="password" id="password" placeholder="Password">
                </div>
                <p class="register-form__error-message">
                    @error('password')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <input type="submit" class="register-form__btn" value="登録">
        </form>
    </div>
</div>
@endsection