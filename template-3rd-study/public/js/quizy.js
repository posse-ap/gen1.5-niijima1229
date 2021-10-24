function show_result(question_number, result, e) {
  document.getElementById("result_box_" + question_number).style.display = "block";
  document.getElementById(e.id).classList.add("red");
  document.getElementById("choices_" + question_number + "_" + 0).classList.remove("red");
  document.getElementById("choices_" + question_number + "_" + 0).classList.add("blue");
  var answerlists = document.getElementsByName("choice_" + question_number);
  answerlists.forEach(function (answerlist) {
    answerlist.style.pointerEvents = 'none';
  });

  if (result == 0) {
    document.getElementById("torf_" + question_number).innerHTML = "正解！";
    document.getElementById("torf_" + question_number).classList.add('yes');
  } else {
    document.getElementById("torf_" + question_number).innerHTML = "不正解！";
    document.getElementById("torf_" + question_number).classList.add('tigai');
  }
}
