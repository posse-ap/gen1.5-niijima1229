<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$items->title_name}}</title>
    <link rel="stylesheet" href="{{ asset('/css/quizy.css') }}">
</head>

<body>
<h1 class="maintitle">{{$items->title_name}}</h1>
<div class="center">
        @foreach($items->questions as $question)
        <div class="box">
          <h2 class="mondai">{{$question->question_number}}.{{$question->question_sentence}}</h2>
          <img src="../img/{{$question->img}}" alt="写真">
          <div class="btn">
          @foreach($question->choices as $choice)
          @if ($choice->valid)
          <p id="choices_{{$question->question_number}}_{{$choice->valid-1}}" name="choice_{{$question->question_number}}" class = "choices" style="order:{{rand(0,10)}}" onclick = "show_result({{$question->question_number}}, {{$choice->valid-1}}, this)">{{$choice->choice_name}}</p>
          @else
          <p id="choices_{{$question->question_number}}_{{$loop->index+1}}" name="choice_{{$question->question_number}}" class = "choices" style="order:{{rand(0,10)}}" onclick = "show_result({{$question->question_number}}, {{$loop->index+1}}, this)">{{$choice->choice_name}}</p>
          @endif
          @endforeach
        </div>
          <div class = "result_box" id = "result_box_{{$question->question_number}}">
            <p id = "torf_{{$question->question_number}}"></p>
            <p id = "description_{{$question->question_number}}">{{$question->commentary}}</p>
          </div>
        </div>
        @endforeach
    </div>
    <script src="{{ asset('/js/quizy.js') }}"></script>
    
</body>
</html>