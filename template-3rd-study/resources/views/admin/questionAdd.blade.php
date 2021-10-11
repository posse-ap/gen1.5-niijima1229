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
  <form action="/admin/question/create" method="post">
    @csrf
    <input type="hidden" name="title_id" value="{{$title_id}}">
    <span>問題番号: </span><input type="text" name="question_number">
    <br>
    <span>問題文: </span><input type="text" name="question_sentence">
    <br>
    <span>写真名: </span><input type="text" name="img">
    <br>
    <span>解説文: </span><input type="text" name="commentary">
    <input type="submit" value="送信">
  </form>
</body>
</html>