@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css')}}">
@endsection

@section('content')
<div class="mypage">
    <div class="reserve">
        <h2 class="reserve__title">予約状況</h2>
        @if (session('success__delete'))
            <div class="alert alert-success">
                {{ session('success__delete') }}
            </div>
        @endif

        @if (session('success__update'))
            <div class="alert alert-success">
                {{ session('success__update') }}
            </div>
        @endif

        @foreach($reserves as $reserve)
            <div class="reserve-status">
                <div class="reserve-header">
                    <div class="reserve-info">
                        <i class="material-icons">access_time_filled</i>
                        <p class="reserve__booking">予約{{ $loop->iteration }}</p>
                    </div>
                    <form action="{{ route('reserve.destroy', $reserve->id) }}" method="POST" class="delete-form" onsubmit="return confirm('本当に削除しますか？');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-button">
                            <i class="material-icons">cancel</i>
                        </button>
                    </form>
                </div>
                <table class="reserve__table">
                    <tr class="reserve__colspan">
                        <th class="reserve__label">Shop</th>
                        <td class="table__data">{{ $reserve->shop_name }}</td>
                    </tr>
                    <tr class="reserve__colspan">
                        <th class="reserve__label">Date</th>
                        <td class="table__data">{{ $reserve->date }}</td>
                    </tr>
                    <tr class="reserve__colspan">
                        <th class="reserve__label">Time</th>
                        <td class="table__data">{{ $reserve->time }}</td>
                    </tr>
                    <tr class="reserve__colspan">
                        <th class="reserve__label">Number</th>
                        <td class="table__data">{{ $reserve->member }}人</td>
                    </tr>
                </table>
                <div class="edit__button">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal-{{ $reserve->id }}">
                        予約内容を変更
                    </button>
                </div>
            </div>

            <div class="modal fade" id="editModal-{{ $reserve->id }}" tabindex="-1" aria-labelledby="editModalLabel-{{ $reserve->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel-{{ $reserve->id }}">予約内容を編集</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
                        </div>
                        <form action="{{ route('reserve.update', $reserve->id) }}" method="POST" onsubmit="return confirm('変更内容は、入力通りでよろしいでしょうか？');">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="shop_name-{{ $reserve->id }}" class="form-label">店舗名</label>
                                    <input type="text" class="form-control" id="shop_name-{{ $reserve->id }}" name="shop_name" value="{{ old('shop_name', $reserve->shop_name) }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="date-{{ $reserve->id }}" class="form-label">予約日</label>
                                    <input type="date" class="form-control" id="date-{{ $reserve->id }}" name="date" value="{{ old('date', $reserve->date) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="time-{{ $reserve->id }}" class="form-label">予約時間</label>
                                    <input type="time" class="form-control" id="time-{{ $reserve->id }}" name="time" value="{{ old('time', $reserve->time) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="member-{{ $reserve->id }}" class="form-label">人数</label>
                                    <input type="number" class="form-control" id="member-{{ $reserve->id }}" name="member" value="{{ old('member', $reserve->member) }}" required min="1">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
                                <button type="submit" class="btn btn-primary">保存</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="favorite">

    @if(Auth::check())
        <h2 class="user">{{ Auth::user()->name }}さん</h2>
    @endif
        <h2 class="favorite-title">お気に入り店舗</h2>
        <div class="cards">

    @php
        $shops = config('shop-data.shop');
    @endphp

    @php
        $favoriteShops = Auth::check() ? Auth::user()->favorites()->pluck('shop_id')->toArray() : [];
    @endphp

    @foreach ($favorites ?? '' as $shopId)
    @php
        $shop = collect($shops)->firstWhere('id', $shopId);
    @endphp
        <div class="card">
            <div class="card__img">
                <img src="{{ $shop['img'] }}" alt="picture">
            </div>
            <div class="card__content">
                <div class="card__content-ttl">{{ $shop['name'] }}</div>
                <div class="card__content-tag">
                    <p class="card__content-tag-item">#{{ $shop['area'] }}</p>
                    <p class="card__content-tag-item">#{{ $shop['genre'] }}</p>
                </div>

                <div class="card__actions">
                    <a href="/detail/{{$shop['id']}}" class="detail-button__favorite">詳しくみる</a>
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
</div>
@endsection