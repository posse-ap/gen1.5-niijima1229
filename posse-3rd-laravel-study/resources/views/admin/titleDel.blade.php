<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{asset('css/admin.css')}}">
  <title>Document</title>
</head>
<body>
  @if(count($errors) > 0)
  <div>
    <ul>
      @foreach($errors->all() as $error)
        <li>{{$error}}</li>
      @endforeach
    </ul>
  </div>
  @endif
  <form action="/admin/title/del" method="post">
    @csrf
    <input type="hidden" name="id" value="{{$form->id}}">
    <p><span>削除するタイトル: </span>{{$form->title_name}}</p>
    <input type="submit" value="送信">
  </form>
</body>
</html>