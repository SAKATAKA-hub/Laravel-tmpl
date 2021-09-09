

@extends('_layouts.base')




@section('title','フォームテンプレート')




@section('style')
<link href="{{ asset('css/form.css') }}" rel="stylesheet">
<!-- bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
@endsection




@section('script')
<!-- bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>

<!-- preview_image -->
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
             <!-- field_text -->
            <label class="form-label" for="{{ $form_id['name'] }}">
                お名前 <span class="badge bg-danger">必須</span>
            </label>

            <!-- field_input -->
            @if ($form == 'create')
                <input class="form-control" type="text" name="name" value="{{ old('name')}}"" id="{{ $form_id['name'] }}" placeholder="苗字　名前">
            @elseif ($form == 'edit')
                <input class="form-control" type="text" name="name" value="{{ old('name', $customer->name) }}"" id="input_name" placeholder="苗字　名前">
            @endif

            <!-- error_text -->
            @error('name')
                <p class="mt-2 text-danger">{{ 'エラー：'.$message }}</p>
            @enderror
        </div>




        <div class="form_group">
            <!-- field_text -->
            <label class="form-label" for="{{ $form_id['email'] }}">
                メールアドレス
            </label>

            <!-- field_input -->
            @if ($form == 'create')
                <input  class="form-control" type="email" name="email" value="{{ old('email')}}" id="{{ $form_id['email'] }}" placeholder="例)email@email.co.jp">
            @elseif ($form == 'edit')
                <input  class="form-control" type="email" name="email" value="{{ old('email', $customer->email) }}" id="{{ $form_id['email'] }}" placeholder="例)email@email.co.jp">
            @endif

            <!-- error_text -->
            @error('email')
                <p class="mt-2 text-danger">{{ 'エラー：'.$message }}</p>
            @enderror
        </div>





        {{-- 画像入力 --}}
        <div class="form_group">
            <!-- field_text -->
            <lavel class="form-label" for="{{ $form_id['image'] }}">
                画像
            </lavel>

            <!-- image -->
            @if ($form == 'create')
                <img id="preview" class="item_image">
            @elseif ($form == 'edit')
                <img id="preview" class="item_image"  src="{{ asset('storage/'.$customer->image) }}">
                <input type="hidden" name="old_image" value = "{{$customer->image}}"> <!-- 以前登録した画像 -->
            @endif

            <!-- field_input -->
            <input class="form-control" type="file" name="image" id="{{ $form_id['image'] }}" onchange="setImage(this);" onclick="this.value = '';">

            <!-- error_text (一つでもエラーがあれば) -->
            <p class="mt-2 text-danger">
                {{ $errors->all()? '画像ファイルを入れ直してください。': '' }}
            </p>

            <!-- error_text (画像にエラー原因があるとき) -->
            @error('image')
                <p class="mt-2 text-danger">{{ 'エラー：'.$message }}</p>
            @enderror

        </div>





        {{-- チェックボックス入力 --}}
        <div class="form_group">
            <label>
                <!-- field_text -->
                <label>
                    お持ちのディバイス
                </label>

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

            </label>
        </div>




        {{-- ラジオボタン入力 --}}
        <div class="form_group">

            <!-- field_text -->
            <label>
                性別 <span class="badge bg-danger">必須</span>
            </label>

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
                @error('gender')
                    <p class="mt-2 text-danger">{{ 'エラー：'.$message }}</p>
                @enderror
        </div>




        {{-- セレクト要素入力 --}}
        <div class="form_group">
            <!-- field_text -->
            <label class="form-label" for="{{ $form_id['age_group'] }}">
                年代 <span class="badge bg-danger">必須</span>
            </label>


            <!-- field_input -->
            <select class="form-select" name="age_group" id="{{ $form_id['age_group'] }}">

                <option value="">選択してください。</option>

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

            <!-- error_text -->
            @error('age_group')
                <p class="mt-2 text-danger">{{ 'エラー：'.$message }}</p>
            @enderror
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
            @error('remarks')
                <p class="mt-2 text-danger">{{ 'エラー：'.$message }}</p>
            @enderror

        </div>




        <div class="form_group">

            <div class="submit_group">
                @if ($form == 'create')

                    <button class="btn btn-primary btn-lg fw-bold"  type="button" data-bs-toggle="modal" data-bs-target="#centerModal">
                        新規登録
                    </button>

                @elseif ($form == 'edit')

                    <button class="btn btn-primary btn-lg fw-bold"  type="button" data-bs-toggle="modal" data-bs-target="#centerModal">
                        上書き保存
                    </button>

                @endif

                <button class="btn btn-outline-primary btn-lg fw-bold" type="button" onclick=" location.href='{{ route('form.list') }}' ">
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
                    'body' => 'この内容で新規登録します。\nよろしいですか？',
                    'yes_btn' => '新規登録',
                ];
            }
            elseif (($form == 'edit')) {
                $modal = [
                    'title' => '入力内容の上書き登録',
                    'body' => 'この内容で上書き登録します。\nよろしいですか？',
                    'yes_btn' => '上書き登録',
                ];
            }
        @endphp

        @include('includes.component.modal')



    </form>


@endsection
