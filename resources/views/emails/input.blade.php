<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>メール入力</title>

    <style>
        p{ margin: 0;}
        label{ display:block; padding: 1em;}
    </style>

</head>
<body>
    <h2 style="border-bottom:solid 1px #eee; padding:16px;">メールの送信</h2>
    <form action="{{route('mail.send')}}" method="POST">
        @csrf
        <label>
            <p>件名</p>
            <input type="text" name="title" required>
        </label>
        <label>
            <p>宛先アドレス</p>
            <input type="text" name="email" required>
        </label>
        <label>
            <p>本文</p>
            <textarea name="body" id="" cols="30" rows="10" required></textarea>
        </label>

        <label>
            <button type="submit">送信</button>
        </label>
    </form>

</body>
</html>
