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
                    <p>{{ $last_name }} {{ $first_name }}</p>
                    <input type="hidden" name="last_name" value="{{ $last_name }}">
                    <input type="hidden" name="first_name" value="{{ $first_name }}">
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">性別</div>
                <div class="form__group-content">
                    <p>
                        @if($gender == 1)
                        男性
                        @elseif($gender == 2)
                        女性
                        @else
                        その他
                        @endif
                    </p>
                    <input type="hidden" name="gender" value="{{ $gender }}">
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">メールアドレス</div>
                <div class="form__group-content">
                    <p>{{ $email }}</p>
                    <input type="hidden" name="email" value="{{ $email }}">
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">電話番号</div>
                <div class="form__group-content">
                    <p>{{ $phone1 }}{{ $phone2 }}{{ $phone3 }}</p>
                    <input type="hidden" name="phone1" value="{{ $phone1 }}">
                    <input type="hidden" name="phone2" value="{{ $phone2 }}">
                    <input type="hidden" name="phone3" value="{{ $phone3 }}">
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">住所</div>
                <div class="form__group-content">
                    <p>{{ $address }}</p>
                    <input type="hidden" name="address" value="{{ $address }}">
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">建物名</div>
                <div class="form__group-content">
                    <p>{{ $building }}</p>
                    <input type="hidden" name="building" value="{{ $building }}">
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">お問い合わせの種類</div>
                <div class="form__group-content">
                    <p>
                        @if($inquiry_type == 1)
                        商品のお届けについて
                        @elseif($inquiry_type == 2)
                        商品交換について
                        @elseif($inquiry_type == 3)
                        商品トラブル
                        @elseif($inquiry_type == 4)
                        ショップへのお問い合わせ
                        @else
                        その他
                        @endif
                    </p>
                    <input type="hidden" name="inquiry_type" value="{{ $inquiry_type }}">
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title--detail">お問い合わせ内容</div>
                <div class="form__group-content">
                    <p>{{ $detail }}</p>
                    <input type="hidden" name="detail" value="{{ $detail }}">
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