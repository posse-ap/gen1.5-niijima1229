<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form action="/user_update" method="post">
        @csrf
        <label for="">
            <p>名前</p>
            <input type="text" name="name" value="{{ $user->name }}">
        </label>
        <label for="">
            <p>メール</p>
            <input type="text" name="email" value="{{ $user->email }}">
        </label>
        <br>
        <button type="submit">送信</button>
    </form>

    <h2>
        削除
    </h2>
    <form action="{{ route('user_destroy', ['id' => $user->id]) }}" method="post">
        @csrf
        <button type="submit">削除</button>
    </form>
</body>

</html>
