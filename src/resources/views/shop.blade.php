@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop.css')}}">
@endsection

@section('header')
    <form action="{{ route('search') }}" method="GET" class="search-form">
        <select name="area" class="search-select">
            <option value="">エリアを選択</option>
            @foreach ($areas as $area)
                <option value="{{ $area }}" {{ request('area') === $area ? 'selected' : '' }}>{{ $area }}</option>
            @endforeach
        </select>

        <select name="genre" class="search-select">
            <option value="">ジャンルを選択</option>
            @foreach ($genres as $genre)
                <option value="{{ $genre }}" {{ request('genre') === $genre ? 'selected' : '' }}>{{ $genre }}</option>
            @endforeach
        </select>

        <input type="text" name="keyword" class="search-input" placeholder="キーワード検索" value="{{ request('keyword') }}">
        <button type="submit" class="search-button">検索</button>
    </form>
@endsection

@section('content')
<div class="shop">
@php
    $favoriteShops = Auth::check() ? Auth::user()->favorites()->pluck('shop_id')->toArray() : [];
@endphp

    @foreach($shops as $shop)
    <div class="shop-card">
        <div class="shop__img">
            <img src="{{$shop['img']}}" alt="{{$shop['name']}}">
        </div>
        <div class="shop-card__content">
            <h2 class="shop__name">{{$shop['name']}}</h2>
            <div class="shop-card__content-tags">
                <div class="shop-card__content-tag-item">#{{$shop['area']}}</div>
                <div class="shop-card__content-tag-item">#{{$shop['genre']}}</div>
            </div>

            <div class="shop-card__actions">
                <a href="/detail/{{$shop['id']}}" class="detail-button__shop">詳しくみる</a>
                <a href="{{ route('favorite.toggle', ['shopId' => $shop['id']]) }}"
                style="color: {{ in_array($shop['id'], $favoriteShops) ? 'red' : 'grey' }};">
                    <i class="material-icons"
                    style="color: {{ in_array($shop['id'], $favoriteShops) ? 'red' : 'grey' }};">favorite</i>
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection