@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="contact-form">
    <div class="contact-form__heading">
        <h2>Contact</h2>
    </div>
    <form class="form" action="/confirm" method="post">
        @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お名前</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__first-name">
                    <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" placeholder="例: 山田" required>
                    <div class="form__error">
                        @error('first_name')<p> {{$errors->first('first_name')}}</p>@enderror
                    </div>
                </div>
                <div class="form__first-name">
                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" placeholder="例: 太郎" required>
                    <div class="form__error">
                        @error('last_name')<p> {{$errors->first('last_name')}}</p>@enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">性別</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__gender">
                    <input type="radio" class="radio__btn" name="gender" value="1" {{ old('gender') == '1' ? 'checked' : '' }}checked> <label>男性</label>
                    <input type="radio" class="radio__btn" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}> <label>女性</label>
                    <input type="radio" class="radio__btn" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}> <label>その他</label>
                </div>
                <div class="form__error">
                    @error('gender')<p> {{$errors->first('gender')}}</p>@enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">メールアドレス</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__email">
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="例: test@example.com" required />
                </div>
                <div class="form__error">
                    @error('email')<p> {{$errors->first('email')}}</p>@enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">電話番号</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__phone">
                    <input type="tel" name="phone1" id="phone1" value="{{ old('phone1') }}" placeholder="090" required />
                    <div class="form__error">
                        @error('phone1')<p>{{$errors->first('phone1')}}</p>@enderror
                    </div>
                    <span>-</span>

                    <input type="tel" name="phone2" id="phone2" value="{{ old('phone2') }}" placeholder="1234" required />
                    <div class="form__error">
                        @error('phone2')<p>{{$errors->first('phone2')}}</p>@enderror
                    </div>
                    <span>-</span>

                    <input type="tel" name="phone3" id="phone3" value="{{ old('phone3') }}" placeholder="5678" required />
                    <div class="form__error">
                        @error('phone3')<p>{{$errors->first('phone3')}}</p>@enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">住所</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__address">
                    <input type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}" required />
                </div>
                <div class="form__error">
                    @error('address')<p>{{$errors->first('address')}}</p>@enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">建物名</span>
            </div>
            <div class="form__group-content">
                <div class="form__building">
                    <input type="text" name="building" value="{{ old('building') }}" placeholder="例: 千駄ヶ谷マンション101" />
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせの種類</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__inquiry-type">
                    <select name="inquiry_type" id="inquiry_type" required>
                        <option value="" disabled selected>選択してください</option>
                        <option value="1" {{ old('inquiry_type') == '1' ? 'selected' : '' }}>商品のお届けについて</option>
                        <option value="2" {{ old('inquiry_type') == '2' ? 'selected' : '' }}>商品交換について</option>
                        <option value="3" {{ old('inquiry_type') == '3' ? 'selected' : '' }}>商品トラブル</option>
                        <option value="4" {{ old('inquiry_type') == '4' ? 'selected' : '' }}>ショップへのお問い合わせ</option>
                        <option value="5" {{ old('inquiry_type') == '5' ? 'selected' : '' }}>その他</option>
                    </select>
                </div>
                <div class="form__error">
                    @error('inquiry_type')<p>{{$errors->first('inquiry_type')}}</p>@enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせ内容</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__detail">
                    <textarea name="detail" placeholder="お問い合わせ内容をご記載ください" required>{{ old('detail') }}</textarea>
                </div>
                <div class="form__error">
                    @error('detail')<p>{{$errors->first('detail')}}</p>@enderror
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">確認画面</button>
        </div>
    </form>
</div>
@endsection