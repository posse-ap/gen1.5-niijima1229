<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>document</title>
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
  <form action="/admin/question/edit" method="post">
    @csrf
    <input type="hidden" name="id" value="{{$question->id}}">
    <input type="hidden" name="title_id" value="{{$question->title_id}}">
    <span>問題番号: </span><input type="text" name="question_number" value="{{$question->question_number}}">
    <br>
    <span>問題文: </span><input type="text" name="question_sentence" value="{{$question->question_sentence}}">
    <br>
    <span>写真名: </span><input type="text" name="img" value="{{$question->img}}">
    <br>
    <span>解説文: </span><input type="text" name="commentary" value="{{$question->commentary}}">
    <input type="submit" value="送信">
</form>

<p>
  <a href="/admin/choice/create?question_id={{$question->id}}">選択肢を新しく追加する</a>
</p>

<p>
  @foreach($question->choices as $choice)
  <a href="/admin/choice/edit?id={{$choice->id}}" class = "choices">{{$choice->choice_name}}</a>
  @endforeach
</p>
</body>
</html>