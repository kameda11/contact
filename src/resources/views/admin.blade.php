@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="admin-page">
    <div class="admin-page__heading">
        <h2>Admin</h2>
    </div>

    <form class="search-form" method="get" action="{{ route('admin') }}">
        @csrf
        <div class="search-form__group">
            <div class="create-form__item">
                <input class="create-form__item-input" type="text" name="content" value="{{ old('content') }}" placeholder=名前やメールアドレスを入力してください />
            </div>
            <div class="search-form__group">
                <label for="search_gender">性別</label>
                <select name="search_gender" id="search_gender" value="{{ request('gender') }}">
                    <option value="man">男性</option>
                    <option value="woman">女性</option>
                    <option value="others">その他</option>
                </select>
            </div>
        </div>

        <div class="search-form__group">
            <select name="search_inquiry_type" id="search_inquiry_type" value="{{ request('inquiry_type') }}">
                <option value="" disabled selected>お問い合わせの種類 </option>
                <option value="1" {{ old('inquiry_type') == '1' ? 'selected' : '' }}>商品のお届けについて</option>
                <option value="2" {{ old('inquiry_type') == '2' ? 'selected' : '' }}>商品交換について</option>
                <option value="3" {{ old('inquiry_type') == '3' ? 'selected' : '' }}>商品トラブル</option>
                <option value="4" {{ old('inquiry_type') == '4' ? 'selected' : '' }}>ショップへのお問い合わせ</option>
                <option value="5" {{ old('inquiry_type') == '5' ? 'selected' : '' }}>その他</option>
        </div>

        <input type="date" id="created_at" name="created_at" value="{{ request('created_at') }}" placeholder=年/月/日 />

        <div class="search-form__button">
            <button type="submit">検索</button>
            <button type="reset">リセット</button>
        </div>
    </form>

    @foreach ($categories as $category)
    <div>
        {{ $category->title }}
    </div>
    @endforeach

    <div class="result-list">
        <table>
            <thead>
                <tr>
                    <th>名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせ内容</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($contacts as $contact)
                <tr>
                    <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                    <td>{{ $contact->gender }}</td>
                    <td>
                        @if($contact->inquiry_type == 1)
                        商品のお届けについて
                        @elseif($contact->inquiry_type == 2)
                        商品交換について
                        @elseif($contact->inquiry_type == 3)
                        商品トラブル
                        @elseif($contact->inquiry_type == 4)
                        ショップへのお問い合わせ
                        @else
                        その他
                        @endif
                    </td>
                    <td>{{ $contact->detail }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">該当するお問い合わせはありません。</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection