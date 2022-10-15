<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @foreach ($contents as $content)
        <form action="{{ route('content_update', ['id' => $content->id]) }}" method="post">
            @csrf
            <p>名前</p>
            <input type="text" name="name" value="{{ $content->name }}">
            <p>色</p>
            <input type="text" name="color" value="{{ $content->color }}">
            <button type="submit">送信</button>
        </form>
        <form action="{{ route('content_destroy', ['id' => $content->id]) }}" method="post">
            @csrf
            <button type="submit">削除</button>
        </form>
    @endforeach
    <h2>新規</h2>
    <form action="{{ route('content_create') }}" method="post">
        @csrf
        <p>名前</p>
        <input type="text" name="name">
        <p>色</p>
        <input type="text" name="color">
        <button type="submit">送信</button>
    </form>
</body>

</html>
