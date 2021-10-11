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
  <form action="/admin/title/edit" method="post">
    @csrf
    <input type="hidden" name="id" value="{{$form->id}}">
    <input type="text" style="width:400px;" name="title_name" value="{{$form->title_name}}">
    <input type="submit" value="送信">
  </form>
  <p>このタイトルを削除する</p>
  <form action="/admin/title/del" method="post">
    @csrf
    <input type="hidden" name="id" value="{{$form->id}}">
    <input type="submit" value="削除">
  </form>
  <p>
  <a href="/admin/question/create?title_id={{$form->id}}">問題を新しく追加する</a>
  </p>
  <p>
  @foreach($form->questions as $question)
    <a href="/admin/question/edit?id={{$question->id}}" class="box">
      <h2 class="mondai">{{$question->question_number}}.{{$question->question_sentence}}</h2>
      <p><span>写真名: </span>{{$question->img}}</p>
      @foreach($question->choices as $choice)
        <p class = "choices">{{$choice->choice_name}}</p>
      @endforeach
      <p>{{$question->commentary}}</p>
    </a>
  @endforeach
  </p>
</body>
</html>