

@extends('_layouts.base')




@section('title','一覧テンプレート')




@section('style')
<link href="{{ asset('css/list.css') }}" rel="stylesheet">
<!-- bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>

<script src="{{ asset('js/common/delete_modal.js') }}"></script>
@endsection








@section('main.center_contents')


    <div class="m-2">{{ Breadcrumbs::render('list') }}</div>

    <div class="list_head">
        <h2>お客様情報一覧</h2>

        {{-- alert --}}
        @if ( $process = session('alert_process') )
            <div class=" alert {{$alert[$process]['color']}} alert-dismissible fade show" role="alert">

                <strong>{{ session('alert_name') }}</strong>{{ $alert[$process]['message'] }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div>
        @endif

        <a href="{{route('form.create')}}"><button class="btn btn-outline-primary fw-bold">新規登録</button></a>
    </div>




    <table>


        @forelse ($customers as $customer)
        <tr class="list_group">
            <td>
                <img class="list_image" src="{{ asset('storage/'.$customer->image) }}">
            </td>
            <td>
                <div class="list_title">{{ $customer->name }} 様</div>
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
                <button class=""  type="button" value="{{ $customer->id }}" data-bs-toggle="modal" data-bs-target="#centerModal"  onclick="deletModalInput(this)">
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
    <form action="{{ route('form.destroy') }}" method="POST">
        @method('DELETE')
        @csrf
        <input type="hidden" name="customer_id" value="" id="deleteInputElement">
        @php
            $modal = [
                'title' => 'お客様情報の削除',
                'body' => 'お客様情報を1件削除します。\nよろしいですか？',
                'yes_btn' => '削除',
            ];
        @endphp
        @include('includes.component.modal')
    </form>
    <!-----------------------------------------------------------------
        * 削除ボタン
        <button class=""  type="button" value="{{ $customer->id }}" data-bs-toggle="modal" data-bs-target="#centerModal"  onclick="deletModalInput(this)">
            削除
        </button>

        * js読込み (deletModalInput関数)
        <script src="{ aseet('js/common/delete_modal.js') }}"></script>
    -------------------------------------------------------------------->




@endsection
