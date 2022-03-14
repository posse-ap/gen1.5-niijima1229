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
  <nav>
    <span><a href="/admin/title/create">問題を新たに作成する</a></span>
    
  </nav>
  @foreach($titles as $title)
  <a href="/admin/title/edit?id={{$title->id}}">{{$title->title_name}}</a>
  <br>
  @endforeach
</body>
</html>
