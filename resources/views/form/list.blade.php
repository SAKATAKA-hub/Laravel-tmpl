

@extends('_layouts.base')




@section('title','一覧テンプレート')




@section('style')
<link href="{{ asset('css/list.css') }}" rel="stylesheet">
<!-- bootstrap -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

@endsection




@section('script')
{{-- javascript なし --}}
@endsection








@section('main.center_contents')
    <div class="list_head">
        <h2>お客様情報一覧</h2>
    </div>




    <table>


        @forelse ($customers as $customer)
        <tr class="list_group">
            <td>
                <img class="list_image" src="{{ asset($customer->image) }}">
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
                <form action="{{ route('form.destroy',$customer) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button>削除</button>
                </form>
            </td>
        </tr>
        @empty

        @endforelse


    </table>



    <div class="list_foot">
        {{ $customers->links('includes.pagination.oliginal') }}
    </div>

@endsection
