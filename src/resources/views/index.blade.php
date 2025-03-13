@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="contact-form__content">
    <div class="contact-form__heading">
        <h2>お問い合わせ</h2>
    </div>
    <form class="form" action="/contacts/confirm" method="post">
        @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お名前</span>
                <span class="form__label--required">必須</span>
                <div class="form__label">
                    <label for="last_name">姓</label>
                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required>
                </div>
                <div class="form__label">
                    <label for="first_name">名</label>
                    <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" required>
                </div>
            </div>
            <!--<div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="name" placeholder="テスト太郎" />
                </div>-->
            <div class="form__error">
                <!--バリデーション機能を実装したら記述します。-->
            </div>
        </div>
</div>
<div class="form__group">
    <label>性別</label><br>
    <input type="radio" name="gender" value="1" checked> 男性
    <input type="radio" name="gender" value="2"> 女性
    <input type="radio" name="gender" value="3"> その他
</div>
<div class="form__group">
    <div class="form__group-title">
        <span class="form__label--item">メールアドレス</span>
        <span class="form__label--required">必須</span>
    </div>
    <div class="form__group-content">
        <div class="form__input--text">
            <input type="email" name="email" placeholder="test@example.com" />
        </div>
        <div class="form__error">
            <!--バリデーション機能を実装したら記述します。-->
        </div>
    </div>
</div>
<div class="form__group">
    <div class="form__group-title">
        <span class="form__label--item">電話番号</span>
        <span class="form__label--required">必須</span>
    </div>
    <div class="form__group-content">
        <div class="form__input--text">
            <input type="tel"
                name="phone1"
                id="phone1"
                placeholder="090"
                pattern="\d{3}"
                maxlength="3"
                required />

            <span>-</span>

            <input type="tel"
                name="phone2"
                id="phone2"
                placeholder="1234"
                pattern="\d{4}"
                maxlength="4"
                required />

            <span>-</span>

            <input type="tel"
                name="phone3"
                id="phone3"
                placeholder="5678"
                pattern="\d{4}"
                maxlength="4"
                required />
        </div>
    </div>
    <div class="form__error">
        <!--バリデーション機能を実装したら記述します。-->
    </div>
</div>
</div>
<div class="form__group">
    <div class="form__group-title">
        <span class="form__label--item">住所</span>
        <span class="form__label--required">必須</span>
    </div>
    <div class="form__group-content">
        <div class="form__input--text">
            <input type="text" name="address" placeholder="テスト太郎" />
        </div>
        <div class="form__error">
            <!--バリデーション機能を実装したら記述します。-->
        </div>
    </div>
</div>
<div class="form__group">
    <div class="form__group-title">
        <span class="form__label--item">建物名</span>
        <span class="form__label--required">必須</span>
    </div>
    <div class="form__group-content">
        <div class="form__input--text">
            <input type="text" name="building" placeholder="テスト太郎" />
        </div>
        <div class="form__error">
            <!--バリデーション機能を実装したら記述します。-->
        </div>
    </div>
</div>
<div class="form__group">
    <label for="inquiry_type">お問い合わせの種類</label>
    <select name="inquiry_type" id="inquiry_type" required>
        <option value="1" {{ old('inquiry_type', '1') == '1' ? 'selected' : '' }}>商品のお届けについて</option>
        <option value="2" {{ old('inquiry_type') == '2' ? 'selected' : '' }}>商品交換について</option>
        <option value="3" {{ old('inquiry_type') == '3' ? 'selected' : '' }}>商品トラブル</option>
        <option value="4" {{ old('inquiry_type') == '4' ? 'selected' : '' }}>ショップへのお問い合わせ</option>
        <option value="5" {{ old('inquiry_type') == '5' ? 'selected' : '' }}>その他</option>
    </select>
</div>
<div class="form__group">
    <div class="form__group-title">
        <span class="form__label--item">お問い合わせ内容</span>
    </div>
    <div class="form__group-content">
        <div class="form__input--textarea">
            <textarea name="content" placeholder="資料をいただきたいです"></textarea>
        </div>
    </div>
</div>
<div class="form__button">
    <button class="form__button-submit" type="submit">送信</button>
</div>
</form>
</div>
@endsection