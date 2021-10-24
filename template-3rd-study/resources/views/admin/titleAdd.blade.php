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
  <form action="/admin/title/create" method="post">
    @csrf
    <input type="text" style="width:400px;" name="title_name">
    <input type="text" style="width:400px;" name="title_number">
    <input type="submit" value="送信">
  </form>
</body>
</html>