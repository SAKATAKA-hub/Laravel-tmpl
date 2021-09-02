

@extends('_layouts.base')




@section('title','一覧テンプレート')




@section('style')
<link href="{{ asset('css/form.css') }}" rel="stylesheet">
<link href="{{ asset('css/app.css') }}" rel="stylesheet"> <!-- bootstrap -->
@endsection




@section('script')
<script src="{{ asset('js/app.js') }}"></script> <!-- bootstrap -->
@endsection








@section('main.center_contents')
    <div class="list_head">
        <h2>お客様情報一覧</h2>
    </div>




    <table>


        @forelse ($customers as $customer)
        <tr class="list_group">
            <td>
                <img class="list_image">
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
                <a href=""><button>一覧</button></a>
            </td>
            <td>
                <a href=""><button>編集</button></a>
            </td>
            <td>
                <form action="">
                    <button>削除</button>
                </form>
            </td>
        </tr>
        @empty

        @endforelse


    </table>



    <div class="list_foot">
        {{ $customers->links() }}
    </div>


@endsection
