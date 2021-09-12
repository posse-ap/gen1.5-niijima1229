function show_result(question_number, result, e) {
  document.getElementById("result_box_"+question_number).style.display = "block";

  document.getElementById(e.id).classList.add("red");

  document.getElementById("choices_"+question_number+"_"+1).classList.remove("red");
  document.getElementById("choices_"+question_number+"_"+1).classList.add("blue");

  for(let i = 0;i < 3;i++){
    // 一度押したら押せなくする
    document.getElementById("choices_"+question_number+"_"+i).classList.add("cantclick");
  }

  if(result == 1) {
    document.getElementById("torf_" + question_number).innerHTML = "正解！";
    document.getElementById("torf_" + question_number).classList.add('yes');

  } else {
    document.getElementById("torf_" + question_number).innerHTML = "不正解！";
    document.getElementById("torf_" + question_number).classList.add('tigai');
  }

}
