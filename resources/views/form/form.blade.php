

@extends('_layouts.base')




@section('title','フォームテンプレート')




@section('style')
<link href="{{ asset('css/form.css') }}" rel="stylesheet">

{{--
<style>
    input[type="text"],input[type="email"],select,textarea{
        padding: 1em;
    }


    .form_head{
        padding: 2rem;
        text-align: center;
    }




    .form_group{
        padding: 1em 3rem;
        border-top: solid 1px #eee;
    }
        .error_text{
            color:red;
            height:1em;
        }
        .form_name
        {
            margin-bottom: .5rem;
        }
        .form_value
        {
            font-size: 1.5em;
            font-weight: bold;
        }
        .item_image{
            width: 100px;
            height: 100px;
            margin-bottom: .5rem;
            border-radius: 10px;
            border: solid 1px #bbb;
            display: block;
        }
        textarea{
            width: 100%;
            height: 6em;
        }





    .submit_group{
        margin-bottom: 1em;
        text-align: center;
    }
        .submit_group button{
            font-size: 1.2rem;
            padding: .2em 2em;
        }




</style> --}}

@endsection




@section('script')
<script src="{{ asset('js/common/preview_image.js') }}"></script>
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

        </div>




        <div class="form_group">
            <label>
                <!-- field_text -->
                <div class="form_name">お名前(必須)</div>

                <!-- field_input -->
                @if ($form == 'create')
                    <input type="text" name="name" value="{{ old('name')}}" placeholder="苗字　名前" required>
                @elseif ($form == 'edit')
                    <input type="text" name="name" value="{{ old('name', $customer->name) }}" placeholder="苗字　名前" required>
                @endif

                <!-- error_text -->
                <p class="error_text">
                    {{ $errors->has('name')? $errors->first('name'): '' }}
                </p>
            </label>
        </div>




        <div class="form_group">
            <label>
                <!-- field_text -->
                <div class="form_name">メールアドレス(必須)</div>

                <!-- field_input -->
                @if ($form == 'create')
                    <input type="email" name="email" value="{{ old('email')}}" placeholder="例)email@email.co.jp" required>
                @elseif ($form == 'edit')
                    <input type="email" name="email" value="{{ old('email', $customer->email) }}" placeholder="例)email@email.co.jp" required>
                @endif

                <!-- error_text -->
                <p class="error_text">
                    {{ $errors->has('email')? $errors->first('email'): '' }}
                </p>

            </label>
        </div>




        {{-- 画像入力 --}}
        <div class="form_group">
            <label>
                <!-- field_text -->
                <div class="form_name">画像</div>

                <!-- image -->
                @if ($form == 'create')
                    <img id="preview" class="item_image">
                @elseif ($form == 'edit')
                    <img id="preview" class="item_image"  src="{{ asset('storage/'.$customer->image) }}">
                    <input type="hidden" name="old_image" value = "{{$customer->image}}"> <!-- 以前登録した画像 -->
                @endif

                <!-- field_input -->
                <input type="file" name="image" onchange="setImage(this);" onclick="this.value = '';">

                <!-- error_text (一つでもエラーがあれば) -->
                <p class="error_text">
                    {{ $errors->all()? '画像ファイルを入れ直してください。': '' }}
                </p>

                <!-- error_text (画像にエラー原因があるとき) -->
                @error('image')
                    <p class="error_text">{{ $message }}</p>
                @enderror
            </label>
        </div>





        {{-- チェックボックス入力 --}}
        <div class="form_group">
            <label>
                <!-- field_text -->
                <div class="form_name">お持ちのディバイス</div>

                <!-- field_input -->
                @foreach ($select_element['divises'] as $divise)

                    @if ( old('divises') ) <!-- (エラーがあるとき) -->

                        <label>
                            <input type="checkbox" name="divises[]" value="{{ $divise->value }}"
                            {{ in_array( $divise->value, old('divises') )?  'checked': ''}}>
                            {{ $divise->text }}
                        </label>

                    @elseif($errors->all()) <!-- (エラーがあり、チェックボックスになにもチェックがないとき) -->

                        <label>
                            <input type="checkbox" name="divises[]" value="{{ $divise->value }}">
                            {{ $divise->text }}
                        </label>

                    @else <!-- (エラーがないとき) -->

                        <label>
                            <input type="checkbox" name="divises[]" value="{{ $divise->value }}"
                            {{ $divise->checked? 'checked': ''}}>
                            {{ $divise->text }}
                        </label>

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
            <label>
                <!-- field_text -->
                <div class="form_name">性別(必須)</div>


                <!-- field_input -->
                @foreach ($select_element['genders'] as $gender)

                    @if ( old('gender') )

                        <label>
                            <input type="radio" name="gender" value="{{ $gender->value }}"
                            {{ old('gender')== $gender->value? 'checked': ''}}>
                            {{ $gender->text }}
                        </label>

                    @else

                        <label>
                            <input type="radio" name="gender" value="{{ $gender->value }}"
                            {{ $gender->checked? 'checked': ''}}>
                            {{ $gender->text }}
                        </label>

                    @endif

                @endforeach


                <!-- error_text -->
                <p class="error_text">
                    {{ $errors->has('gender')? $errors->first('gender'): '' }}
                </p>
            </label>
        </div>




        {{-- セレクト要素入力 --}}
        <div class="form_group">
            <label>
                <!-- field_text -->
                <div class="form_name">年代(必須)</div>


                <!-- field_input -->
                <select name="age_group">
                @foreach ($select_element['age_groups'] as $age_group)

                    @if ( old('gender') )

                        <option value="{{ $age_group->value }}"
                            {{ old('age_group') == $age_group->value? 'selected': ''}}>
                            {{ $age_group->text }}
                        </option>

                    @else

                        <option value="{{ $age_group->value }}"
                            {{ $age_group->selected? 'selected': ''}}>
                            {{ $age_group->text }}
                        </option>

                    @endif

                @endforeach
                </select>
            </label>
        </div>




        {{-- テキストエリア入力 --}}
        <div class="form_group">
            <label>
                <!-- field_text -->
                <div class="form_name">特記事項</div>

                <!-- field_input -->
                @if ($form == 'create')
                    <textarea name="remarks">特記事項があれば記入してください。</textarea>

                @elseif ($form == 'edit')
                    <textarea name="remarks">{{ old('remarks', $customer->remarks) }}</textarea>

                @endif

                <!-- error_text -->
                <p class="error_text">
                    {{ $errors->has('remarks')? $errors->first('remarks'): '' }}
                </p>
            </label>
        </div>




        <div class="form_group">


            <div class="submit_group">
                @if ($form == 'create')
                    <button type="submit">新規登録</button>
                @elseif ($form == 'edit')
                    <button type="submit">上書き保存</button>
                @endif


                <button type="button" onclick=" location.href='{{ route('form.list') }}' ">戻る</button>
            </div>


            <div  class="submit_group">
                <a href="">ホーム</a>
                <a href="">お問い合わせ</a>
                <a href="">プライバシー</a>
            </div>
        </div>


    </form>


@endsection
