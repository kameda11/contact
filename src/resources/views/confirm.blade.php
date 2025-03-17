@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="contact-form">
    <div class="contact-form__heading">
        <h2>Confirm</h2>
    </div>

    <form class="form" action="/thanks" method="post">
        @csrf
        <div class="form__point">
            <div class="form__group">
                <div class="form__group-title">お名前</div>
                <div class="form__group-content">
                    <p>{{ $data['last_name'] }} {{ $data['first_name'] }}</p>
                        <input type="hidden" name="last_name" value="{{ $data['last_name'] }}">
                        <input type="hidden" name="first_name" value="{{ $data['first_name'] }}">
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">性別</div>
                <div class="form__group-content">
                    <p>
                        {{ $data['gender'] }}
                    </p>
                    <input type="hidden" name="gender" value="{{ $data['gender'] }}">
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">メールアドレス</div>
                <div class="form__group-content">
                    <p>{{ $data['email'] }}</p>
                    <input type="hidden" name="email" value="{{ $data['email'] }}">
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">電話番号</div>
                <div class="form__group-content">
                    <p>{{ $data['phone1'] }}{{ $data['phone2'] }}{{ $data['phone3'] }}</p>
                    <input type="hidden" name="phone1" value="{{ $data['phone1'] }}">
                    <input type="hidden" name="phone2" value="{{ $data['phone2'] }}">
                    <input type="hidden" name="phone3" value="{{ $data['phone3'] }}">
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">住所</div>
                <div class="form__group-content">
                    <p>{{ $data['address'] }}</p>
                    <input type="hidden" name="address" value="{{ $data['address'] }}">
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">建物名</div>
                <div class="form__group-content">
                    <p>{{ $data['building'] ?? ' ' }}</p>
                    <input type="hidden" name="building" value="{{ $data['building'] ?? '' }}">
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">お問い合わせの種類</div>
                <div class="form__group-content">
                    <p>
                        {{ $data['inquiry_type'] }}
                    </p>
                    <input type="hidden" name="inquiry_type" value="{{ $data['inquiry_type'] }}">
                </div>
            </div>

            <div class=" form__group">
                <div class="form__group-title--detail">お問い合わせ内容</div>
                <div class="form__group-content">
                    <p>{{ $data['detail'] }}</p>
                    <input type="hidden" name="detail" value="{{ $data['detail'] }}">
                </div>
            </div>
        </div>

        <div class="form__button">
            <button class="form__button-submit" type="submit">送信</button>
            <a class="form__button-back" href="/">修正</a>
        </div>
    </form>
</div>
@endsection