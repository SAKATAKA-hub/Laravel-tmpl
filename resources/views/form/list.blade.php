

@extends('_layouts.base')




@section('title','一覧テンプレート')




@section('style')
<link href="{{ asset('css/list.css') }}" rel="stylesheet">
<!-- bootstrap -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<style>
    .popup_message{
        width: 100%;
        line-height: 2em;
        padding-left: 2em;
        background: lightsalmon;
        font-weight: bold;
    }
</style>
@endsection




@section('script')
<!-- bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src="{{ asset('js/common/delete_modal.js') }}"></script>
@endsection








@section('main.center_contents')


    @if ( session('popup_message') )
        <div class="popup_message">{{ session('popup_message') }}</div>
    @endif

    <div class="list_head">
        <h2>お客様情報一覧</h2>
        <a href="{{route('form.create')}}"><button class="btn btn-outline-info">新規登録</button></a>
    </div>




    <table>


        @forelse ($customers as $customer)
        <tr class="list_group">
            <td>
                <img class="list_image" src="{{ asset('storage/'.$customer->image) }}">
            </td>
            <td>
                <div class="list_title">{{ $customer->name }}</div>
            </td>
            <td>
                <div>{{ $customer->gender }}</div>
            </td>
            <td>
                <div>{{ $customer->age_group }}</div>
            </td>
            <td>
                <div class="list_updated_at">20**年00月00日に更新</div>
            </td>
            <td>
                <a href="{{ route('form.show',$customer) }}"><button>詳細</button></a>
            </td>
            <td>
                <a href="{{ route('form.edit',$customer) }}"><button>編集</button></a>
            </td>
            <td>
                <button type="button" value="{{ $customer->id }}" data-toggle="modal" data-target="#modalCenter" onclick="deletModalInput(this)">
                    削除
                </button>
            </td>
        </tr>
        @empty

        @endforelse


    </table>




    <div class="list_foot">
        {{ $customers->links('includes.pagination.oliginal') }}
    </div>









    {{-- Modal(データ削除モーダル) --}}
    <form action="{{ route('form.destroy',1) }}" method="POST">
        @method('DELETE')
        @csrf
        <input type="hidden" name="customer_id" value="" id="deleteInputElement">
        @php
            $modal = [
                    'title' => 'お客様情報の削除',
                    'body' => 'お客様情報を1件削除します。</br>よろしいですか？',
            ];
        @endphp
        @include('includes.component.modal')
    </form>
    <!-----------------------------------------------------------------
        * 削除ボタン
        <button class="btn btn-outline-secondary" type="button" value="{{ $customer->id }}" data-toggle="modal" data-target="#modalCenter" onclick="deletModalInput(this)">
            削除
        </button>

        * js読込み
        <script src="{ aseet('js/common/delete_modal.js') }}"></script>
    -------------------------------------------------------------------->




@endsection
