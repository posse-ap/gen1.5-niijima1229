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
  <form action="/admin/choice/edit" method="post">
    @csrf
    <input type="hidden" name="id" value="{{$choice->id}}">
    <br>
    <input type="hidden" name="question_id" value="{{$choice->question_id}}">
    <span>選択肢名: </span><input type="text" name="choice_name" value="{{$choice->choice_name}}">
    <br>
    <span>正解不正解: </span><input type="radio" name="valid" value="1" @if ($choice->valid == 1) checked @endif>正解<input type="radio" name="valid" value="0 @if ($choice->valid == 0) checked @endif">不正解
    <br>
    <input type="submit" value="送信">
</form>

<p>
  <form action="/admin/choice/del" method="post">
    @csrf
    <input type="hidden" name="id" value="{{$choice->id}}">
    <input type="submit" value="削除">
  </form>
</p>

</body>
</html>