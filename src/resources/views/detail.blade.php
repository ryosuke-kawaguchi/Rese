@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css')}}">
@endsection

@section('content')
<div class="flex__item">
<div class="detail">
    <div class="detail__content">

        <div class="detail__header">
            <a href="/" class="back-button"><i class="material-icons">arrow_back_ios</i></a>
            <h1 class="detail__name">{{ $shop['name'] }}</h1>
        </div>

        <div class="detail__img">
            <img src="{{ $shop['img'] }}" alt="店舗">
        </div>
        <div class="detail__card__content-tags">
            <p class="detail__card__content-tag-item">#{{ $shop['area'] }}</p>
            <p class="detail__card__content-tag-item">#{{ $shop['genre'] }}</p>
        </div>
        <p class="detail__text">{{ $shop['text'] }}</p>
    </div>
</div>
<div class="reserve-form">
    <h1 class="reserve-form__ttl">予約</h1>
        <form action="{{ route('reserve.store') }}" method="post" class="detail__form" onsubmit="return confirm('こちらの予約内容でよろしいでしょうか？');">
            @csrf
            <div class="detail__form-group">
                <input type="date" name="date" id="dateInput" value="{{ date('Y-m-d') }}" class="detail__form-input">
                <input type="time" name="time" id="timeInput" step="1800" value="17:30" class="detail__form-input">
                <input type="number" name="member" id="numberInput" min="1" value="1人" class="detail__form-input">
                <input type="hidden" name="shop_name" value="{{ $shop['name'] }}">
            </div>
            <div class="reserve-confirm">
                <table class="reserve-confirm__table">
                    <tr class="reserve-confirm__colspan">
                        <th class="reserve-confirm__label">Shop</th>
                        <td class="reserve-confirm__data">{{ $shop['name'] }}</td>
                    </tr>
                    <tr class="reserve-confirm__colspan">
                        <th class="reserve-confirm__label">Date</th>
                        <td class="reserve-confirm__data" id="dateDisplay">日付</td>
                    </tr>
                    <tr class="reserve-confirm__colspan">
                        <th class="reserve-confirm__label">Time</th>
                        <td class="reserve-confirm__data" id="timeDisplay">時間</td>
                    </tr>
                    <tr class="reserve-confirm__colspan">
                        <th class="reserve-confirm__label">Number</th>
                        <td class="reserve-confirm__data" id="numberDisplay">人数</td>
                    </tr>
                </table>
            </div>
            <button type="submit" class="reserve__button">予約する</button>
        </form>


    <script>
        const dateInput = document.getElementById('dateInput');
        const timeInput = document.getElementById('timeInput');
        const numberInput = document.getElementById('numberInput');

        const dateDisplay = document.getElementById('dateDisplay');
        const timeDisplay = document.getElementById('timeDisplay');
        const numberDisplay = document.getElementById('numberDisplay');

        dateInput.addEventListener('input', () => {
            dateDisplay.textContent = dateInput.value;
        });

        timeInput.addEventListener('input', () => {
            timeDisplay.textContent = timeInput.value;
        });

        numberInput.addEventListener('input', () => {
            numberDisplay.textContent = numberInput.value + '人';
        });
    </script>

</div>
@endsection