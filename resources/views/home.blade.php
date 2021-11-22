<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>tmpl home</title>
</head>
<body>
    <h1>tmpl home</h1>


    <ul>

        <li><a href="{{route('form.list')}}">
            フォームテンプレート(お客様情報一覧)
        </a></li>

        <li><a href="{{route('memo.list')}}">
            非同期通信テンプレート(メモ一覧)
        </a></li>

    </ul>

</body>
</html>
