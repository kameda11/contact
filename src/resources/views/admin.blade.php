@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="admin-page">
    <div class="admin-page__heading">
        <h2>Admin</h2>
    </div>
    <div class="search-form">
        <form method="get" action="{{ route('admin') }}">
            @csrf
            <div class="search-form__group">
                <input class="create-form__item-input" type="text" name="content" value="{{ request('content') }}" placeholder="名前やメールアドレスを入力してください" />
                <div class="search_gender">
                    <select name="search_gender" id="search_gender">
                        <option value="" selected>性別
                        </option>
                        <option value="man" {{ request('search_gender') === 'man' ? 'selected' : '' }}>男性</option>
                        <option value="woman" {{ request('search_gender') === 'woman' ? 'selected' : '' }}>女性</option>
                        <option value="others" {{ request('search_gender') === 'others' ? 'selected' : '' }}>その他</option>
                    </select>
                </div>
                <div class="search_inquiry_type">
                    <select name="search_inquiry_type" id="search_inquiry_type">
                        <option value="" disabled selected>お問い合わせの種類 </option>
                        <option value="1" {{ request('search_inquiry_type') == '1' ? 'selected' : '' }}>商品のお届けについて</option>
                        <option value="2" {{ request('search_inquiry_type') == '2' ? 'selected' : '' }}>商品交換について</option>
                        <option value="3" {{ request('search_inquiry_type') == '3' ? 'selected' : '' }}>商品トラブル</option>
                        <option value="4" {{ request('search_inquiry_type') == '4' ? 'selected' : '' }}>ショップへのお問い合わせ</option>
                        <option value="5" {{ request('search_inquiry_type') == '5' ? 'selected' : '' }}>その他</option>
                    </select>
                </div>
                <input class="search_date" type="date" id="created_at" name="created_at" value="{{ request('created_at') }}" placeholder=年/月/日 />
                <div class="search-form__button">
                    <button class="submit" type="submit">検索</button>
                    <a href="{{ route('admin') }}" class="secondary">リセット</a>
                </div>
        </form>
    </div>

    @foreach ($categories as $category)
    <div>
        {{ $category->title }}
    </div>
    @endforeach

    <div class="export-pagination">
        <a href="{{ route('export.csv') }}" class="btn btn-primary">エクスポート</a>
        <div class="pagination-wrapper">
            <div class="pagination">
                {{ $contacts->links() }}
            </div>
        </div>
    </div>
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
                    <td>
                        @if($contact->gender == '1')
                        男性
                        @elseif($contact->gender == '2')
                        女性
                        @else
                        その他
                        @endif
                    </td>
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
                    <td>
                        <button type="button" class="btn btn-info detail-btn" data-id="{{ $contact->id }}">詳細</button>
                    </td>
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


<div id="detailModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>お問い合わせ詳細</h2>
        <p><strong>名前：</strong> <span id="modal-name"></span></p>
        <p><strong>性別：</strong> <span id="modal-gender"></span></p>
        <p><strong>メールアドレス：</strong> <span id="modal-email"></span></p>
        <p><strong>電話番号：</strong> <span id="modal-phone"></span></p>
        <p><strong>住所：</strong> <span id="modal-address"></span></p>
        <p><strong>建物名：</strong> <span id="modal-building"></span></p>
        <p><strong>お問い合わせの種類：</strong> <span id="modal-inquiry-type"></span></p>
        <p><strong>お問い合わせ内容：</strong> <span id="modal-detail"></span></p>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('detailModal');
        const closeModal = document.querySelector('.close');

        document.querySelectorAll('.detail-btn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');

                fetch(`/api/contacts/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('modal-name').textContent = data.name;
                        document.getElementById('modal-gender').textContent = data.gender;
                        document.getElementById('modal-email').textContent = data.email;
                        document.getElementById('modal-phone').textContent = data.phone;
                        document.getElementById('modal-address').textContent = data.address;
                        document.getElementById('modal-building').textContent = data.building;
                        document.getElementById('modal-inquiry-type').textContent = data.inquiry_type;
                        document.getElementById('modal-detail').textContent = data.detail;

                        modal.style.display = 'block';
                        modal.classList.add('show');
                    })
                    .catch(error => console.error('Error:', error));
            });
        });

        closeModal.addEventListener('click', function() {
            modal.classList.remove('show');
            modal.style.display = 'none';
        });

        window.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.classList.remove('show');
                modal.style.display = 'none';
            }
        });
    });
</script>
@endsection