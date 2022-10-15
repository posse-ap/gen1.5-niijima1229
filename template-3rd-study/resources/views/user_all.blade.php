<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @foreach ($users as $user)
        <p>ユーザー名</p>
        <p>{{ $user->name }}</p>
    @endforeach
    <h2>新規作成</h2>
    <form action="{{ route('user_create') }}" method="post">
        @csrf
        <p>名前</p>
        <input type="text" name="name">
        <p>メール</p>
        <input type="text" name="email">
        <p>パスワード</p>
        <input type="text" name="password">
        <p>権限</p>
        <label for="">
            <input type="radio" name="role_id" value=1>
            <span>一般</span>
        </label>
        <label for="">
            <input type="radio" name="role_id" value=2>
            <span>管理者</span>
        </label>
        <input type="submit" value="送信">
    </form>
</body>

</html>
