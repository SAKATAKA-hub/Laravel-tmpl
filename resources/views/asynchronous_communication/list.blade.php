<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>asynchronous communication</title>
    <meta name="token" content="{{ csrf_token() }}">


    <style>
        body{
            margin: 0 2em;
        }
        h1{
            border-bottom: solid 2px #ccc;
            padding-left: 32px;
        }
        .container{
            padding-left: 32px;
        }
        li[class="hidden"]{
            display: none;
        }
    </style>
</head>
<body>
    <h1>メモ</h1>

    <div class="container">

        <!-- メモの挿入 -->

        <form action="" id="postForm"
            data-url="{{route('memo.store')}}"
            data-destoroy_url="{{route('memo.destoroy','')}}"
        >
            <input type="text" name="body" id="post" required>
            <button type="submit">保存</button>
        </form>




        <!-- メモの一覧 -->
        <h2>メモ一覧</h2>
        <ul>
            @forelse ($memos as $memo)
                <li class="">
                    {{$memo->body}}
                    <span class="deleteBtn" data-url="{{route('memo.destoroy',$memo->id)}}">[×]</span>
                </li>
            @empty
                <li style="color:#ccc;">メモ内容はありません</li>
            @endforelse
        </ul>
    </div>

    <script>
        'use strict';

        // token
        const token = document.querySelector('meta[name="token"]').content; //トークン(メタタグに保存)
        // 値の入力フォーム
        const postForm = document.getElementById('postForm');
        // 値の入力
        const post = document.getElementById('post');
        // 入力された値の一覧
        const ul = document.querySelector('ul');
        // 全ての削除ボタン
        let deleteBtns =  document.querySelectorAll('.deleteBtn');






        //----------------------------------------------------------------
        // メモの挿入
        //----------------------------------------------------------------

        postForm.addEventListener('submit', e =>{

            // ページ遷移防止
            e.preventDefault();

            const postValue = post.value;

            console.log(postValue);

            // 非同期通信
            fetch(postForm.dataset.url, {
                method: 'POST',
                body: new URLSearchParams({
                    _token: token,
                    body : postValue,
                }),
            })
            .then(response => response.json())
            .then(json => {
                console.log(json.id)

                // 新しい値の要素を追加する
                const newElement = document.createElement('li');

                const destoroyUrl = postForm.dataset.destoroy_url;
                const span ='<span class="deleteBtn" data-url="'+ destoroyUrl + '/' + json.id +'"> [×]</span>';


                newElement.innerHTML = postValue + span;
                ul.insertBefore(newElement, ul.querySelectorAll('li')[0]);

                console.log(ul);

                // 全ての削除ボタンの更新
                deleteBtns =  document.querySelectorAll('.deleteBtn');
                console.log(deleteBtns);


            })
            ;




            // 入力枠を空白に戻す
            post.value = '';
        });




        //----------------------------------------------------------------
        // メモの削除
        //----------------------------------------------------------------
        deleteBtns.forEach( (deleteBtn, index) => {

            // [×]ボタンがクリックされた時
            deleteBtn.addEventListener('click',()=>{

                // データの送信
                const url = deleteBtn.dataset.url;
                const options = {
                    method: 'POST',
                    body: new URLSearchParams({
                        _method: 'delete', //メソッド('update','delete'のとき)
                        _token: token,
                    }),
                };
                fetch(url, options);

                // 削除要素を非表示にする
                deleteBtn.parentNode.classList.add('hidden')

                console.log('delete'+index);


            });
        });

    </script>
</body>
</html>
