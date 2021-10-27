

@extends('_layouts.base')




@section('title','表示テンプレート')




@section('style')
<link href="{{ asset('css/show.css') }}" rel="stylesheet">
@endsection




@section('script')
{{-- javascript なし --}}
@endsection








@section('main.center_contents')

    <div class="item_head">
        <h2>お客様情報</h2>
    </div>


    <div class="item_group">
        <div class="item_name">画像</div>
        <img class="item_image" src="{{ asset('storage/'.$customer->image) }}">
    </div>


    <div class="item_group">
        <div class="item_name">お名前</div>
        <div class="item_value">{{ $customer->name }}</div>
    </div>


    <div class="item_group">
        <div class="item_name">メールアドレス</div>
        <div class="item_value">{{ $customer->email }}</div>
    </div>


    <div class="item_group">
        <div class="item_name">お持ちのディバイス</div>
        <div class="item_value">{{ $customer->divises!=''? $customer->divises: 'なし' }}</div>
    </div>


    <div class="item_group">
        <div class="item_name">性別</div>
        <div class="item_value">{{ $customer->gender }}</div>
    </div>


    <div class="item_group">
        <div class="item_name">年代</div>
        <div class="item_value">{{ $customer->age_group }}</div>
    </div>


    <div class="item_group">
        <div  class="item_name">ご意見</div>
        <div class="item_value">{!! nl2br( e($customer->remarks) ) !!}</div>
    </div>


    <div class="item_group submit_group">
        <a href="{{ route('form.list') }}"><button type="submit">戻る</button></a>
        <div>
            <a href="">ホーム</a>
            <a href="">お問い合わせ</a>
            <a href="">プライバシー</a>
        </div>
    </div>

@endsection
