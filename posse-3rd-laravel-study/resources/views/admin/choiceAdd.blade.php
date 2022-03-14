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
  <form action="/admin/choice/create" method="post">
    @csrf
    <input type="hidden" name="question_id" value="{{$question_id}}">
    <span>選択肢名: </span><input type="text" name="choice_name">
    <br>
    <span>正解不正解: </span><input type="radio" name="valid" value="1">正解<input type="radio" name="valid" value="0">不正解
    <br>
    <input type="submit" value="送信">
  </form>
</body>
</html>