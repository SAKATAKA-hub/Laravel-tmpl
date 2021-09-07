

@extends('_layouts.base')




@section('title','フォームテンプレート')




@section('style')
<link href="{{ asset('css/form.css') }}" rel="stylesheet">
<!-- bootstrap -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
{{-- <style>

.form_head{
    padding: 2rem;
    text-align: center;
}




.form_group{
    padding: 1em 3rem;
    border-top: solid 1px #eee;
}

    .item_image{
        width: 100px;
        height: 100px;
        margin-bottom: .5rem;
        border-radius: 10px;
        border: solid 1px #bbb;
        display: block;
    }




.submit_group{
    margin-bottom: 1em;
    text-align: center;
}
</style> --}}
@endsection




@section('script')
<!-- bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<!-- preview_image -->
<script src="{{ asset('js/common/preview_image.js') }}"></script>
{{-- <script src="{{ asset('js/app.js') }}"></script> --}}

@endsection








@section('main.center_contents')




    @if ($form == 'create')
        <form action="{{ route('form.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

    @elseif ($form == 'edit')
        <form action="{{ route('form.update',$customer) }}" method="POST" enctype="multipart/form-data">
            @method('PATCH')
            @csrf

    @endif




        <div class="form_head">
            @if ($form == 'create')
                <h2>お客様情報新規登録</h2>
            @elseif ($form == 'edit')
                <h2>お客様情報修正</h2>
            @endif

            {{-- アラートメッセージ --}}
            <div class=" alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
             </div>
        </div>


        <div class="form_group">
             <!-- field_text -->
            <label class="form-label" for="{{ $form_id['name'] }}">お名前 <span class="badge badge-danger">必須</span></label>

            <!-- field_input -->
            @if ($form == 'create')
                <input class="form-control" type="text" name="name" value="{{ old('name')}}"" id="{{ $form_id['name'] }}" placeholder="苗字　名前" required>
            @elseif ($form == 'edit')
                <input class="form-control" type="text" name="name" value="{{ old('name', $customer->name) }}"" id="input_name" placeholder="苗字　名前" required>
            @endif

            <!-- error_text -->
            <p style="color:red;margin-top:.5em;">jsエラーメッセージ</p>
            <p class="error_text">
                {{ $errors->has('name')? $errors->first('name'): '' }}
            </p>
        </div>




        <div class="form_group">
            <!-- field_text -->
            <label class="form-label" for="{{ $form_id['email'] }}">メールアドレス</label>

            <!-- field_input -->
            @if ($form == 'create')
                <input  class="form-control" type="email" name="email" value="{{ old('email')}}" id="{{ $form_id['email'] }}" placeholder="例)email@email.co.jp" required>
            @elseif ($form == 'edit')
                <input  class="form-control" type="email" name="email" value="{{ old('email', $customer->email) }}" id="{{ $form_id['email'] }}" placeholder="例)email@email.co.jp" required>
            @endif

            <!-- error_text -->
            <p style="color:red;margin-top:.5em;">jsエラーメッセージ</p>
            <p class="error_text">
                {{ $errors->has('name')? $errors->first('name'): '' }}
            </p>
        </div>





        {{-- 画像入力 --}}
        <div class="form_group">
            <!-- field_text -->
            <lavel class="form-label" for="{{ $form_id['image'] }}">画像</lavel>

            <!-- image -->
            @if ($form == 'create')
                <img id="preview" class="item_image">
            @elseif ($form == 'edit')
                <img id="preview" class="item_image"  src="{{ asset('storage/'.$customer->image) }}">
                <input type="hidden" name="old_image" value = "{{$customer->image}}"> <!-- 以前登録した画像 -->
            @endif

            <!-- field_input -->
            <input class="form-control-file" type="file" name="image" id="{{ $form_id['image'] }}" onchange="setImage(this);" onclick="this.value = '';">

            <!-- error_text (一つでもエラーがあれば) -->
            <p class="error_text">
                {{ $errors->all()? '画像ファイルを入れ直してください。': '' }}
            </p>

            <!-- error_text (画像にエラー原因があるとき) -->
            @error('image')
                <p class="error_text">{{ $message }}</p>
            @enderror
        </div>





        {{-- チェックボックス入力 --}}
        <div class="form_group">
            <label>
                <!-- field_text -->
                <label>お持ちのディバイス</label>

                <!-- field_input -->
                @foreach ($select_element['divises'] as $divise)

                    @if ( old('divises') ) <!-- (エラーがあるとき) -->

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="divises[]" value="{{ $divise->value }}" id="{{$divise->form_id}}"
                            {{ in_array( $divise->value, old('divises') )?  'checked': ''}}>

                            <label class="form-check-label" for="{{$divise->form_id}}"> {{ $divise->text }} </label> <!-- (テキスト) -->
                        </div>

                    @elseif($errors->all()) <!-- (エラーがあり、チェックボックスになにもチェックがないとき) -->

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="divises[]" value="{{ $divise->value }}" id="{{$divise->form_id}}">
                            <label class="form-check-label" for="{{$divise->form_id}}"> {{ $divise->text }} </label>　<!-- (テキスト) -->
                        </div>

                    @else <!-- (エラーがないとき) -->

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="divises[]" value="{{ $divise->value }}" id="{{$divise->form_id}}"
                            {{ $divise->checked? 'checked': ''}}>

                            <label class="form-check-label" for="{{$divise->form_id}}"> {{ $divise->text }} </label>　<!-- (テキスト) -->
                        </div>
                    @endif

                @endforeach

                <!-- error_text -->
                <p class="error_text">
                    {{ $errors->has('divises[]')? $errors->first('divises[]'): '' }}
                </p>
            </label>
        </div>




        {{-- ラジオボタン入力 --}}
        <div class="form_group">

            <!-- field_text -->
            <label>性別 <span class="badge badge-danger">必須</span></label>

            <!-- field_input -->
            @foreach ($select_element['genders'] as $gender)

                @if ( old('gender') ) <!-- (エラーがあるとき) -->

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" value="{{ $gender->value }}" id="{{ $gender->form_id }}"
                        {{ old('gender')== $gender->value? 'checked': ''}}>
                        <label class="form-check-label" for="{{ $gender->form_id }}"> {{ $gender->text }} </label>
                    </div>

                @else  <!-- (エラーがないとき) -->

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" value="{{ $gender->value }}" id="{{ $gender->form_id }}"
                        {{ $gender->checked? 'checked': ''}}>

                        <label class="form-check-label" for="{{ $gender->form_id }}"> {{ $gender->text }} </label>
                    </div>

                @endif

            @endforeach


            <!-- error_text -->
            <p class="error_text">
                {{ $errors->has('gender')? $errors->first('gender'): '' }}
            </p>
        </div>




        {{-- セレクト要素入力 --}}
        <div class="form_group">
            <!-- field_text -->
            <label class="form-label" for="{{ $form_id['age_group'] }}">年代(必須)</label>


            <!-- field_input -->
            <select class="form-control" name="age_group" id="{{ $form_id['age_group'] }}">
                @foreach ($select_element['age_groups'] as $age_group)

                    @if ( old('gender') )

                        <option value="{{ $age_group->value }}"
                            {{ old('age_group') == $age_group->value? 'selected': ''}}>
                            {{ $age_group->text }}
                        </option>

                    @else

                        <option value="{{ $age_group->value }}" {{ $age_group->selected? 'selected': ''}}>
                            {{ $age_group->text }}
                        </option>


                    @endif

                @endforeach
            </select>

        </div>




        {{-- テキストエリア入力 --}}
        <div class="form_group">
            <!-- field_text -->
            <label class="form-label" for="{{ $form_id['remarks'] }}">特記事項</label>

            <!-- field_input -->
            @if ($form == 'create')
                <textarea type="text" name="remarks" class="form-control" placeholder="特記事項を記入。"
                id="{{ $form_id['remarks'] }}" ></textarea>

            @elseif ($form == 'edit')
                <textarea type="text" name="remarks" class="form-control"
                id="{{ $form_id['remarks'] }}">{{ old('remarks', $customer->remarks) }}</textarea>

            @endif

            <!-- error_text -->
            <p class="error_text">
                {{ $errors->has('remarks')? $errors->first('remarks'): '' }}
            </p>

        </div>




        <div class="form_group">

            <div class="submit_group">
                @if ($form == 'create')
                    <button class="btn btn-primary btn-lg" type="button" data-toggle="modal" data-target="##modalCenter">
                        新規登録
                    </button>

                @elseif ($form == 'edit')
                    <button class="btn btn-primary btn-lg" type="button" data-toggle="modal" data-target="#modalCenter">
                        上書き保存
                    </button>

                @endif

                <button class="btn btn-outline-primary btn-lg" type="button" onclick=" location.href='{{ route('form.list') }}' ">
                    戻る
                </button>

            </div>

            <div class="submit_group">
                <a href="" class="btn btn-link">お問い合わせ</a>
                <a href="" class="btn btn-link">ホーム</a>
                <a href="" class="btn btn-link">プライバシー</a>
            </div>
        </div>




        {{-- Modal(確認モーダル) --}}
        @php
            $modal = [];
            if ($form == 'create') {
                $modal = [
                    'title' => '入力内容の新規登録',
                    'body' => 'この内容で新規登録します。</br>よろしいですか？',
                ];
            }
            elseif (($form == 'edit')) {
                $modal = [
                    'title' => '入力内容の上書き保存',
                    'body' => 'この内容で上書き保存します。</br>よろしいですか？',
                ];
            }
        @endphp

        @include('includes.component.modal')



    </form>


@endsection
