//選択肢を配列に入れる
let sentakusi = new Array();
    sentakusi.push(["たかなわ", "こうわ", "たかわ"]);
    sentakusi.push(["かめいど", "かめと", "かめど"]);
    sentakusi.push(["こうじまち", "おかとまち", "かゆまち"]);
    sentakusi.push(["おなりもん", "おかどもん", "ごせいもん"]);
    sentakusi.push(["とどろき", "たたら", "たたりき"]);
    sentakusi.push(["しゃくじい", "せきこうい", "いじい"]);
    sentakusi.push(["ぞうしき", "ざっしき", "ざっしょく"]);
    sentakusi.push(["おかちまち", "みとちょう", "ごしろちょう"]);
    sentakusi.push(["ししぼね", "しこね", "ろっこつ"]);
    sentakusi.push(["こぐれ", "こばく", "こしゃく"]);

    

//それぞれをシャッフル
sentakusi.forEach (function(sentakusi,item){
    // 答えと間違い全ての最初の位置を記録
    answer = sentakusi[0];
    miss1 = sentakusi[1];
    miss2 = sentakusi[2];
    
    let r;
    let temp;

    //シャッフル関数
    for(let i = sentakusi.length - 1; i >= 0; i--){
      r = Math.floor(Math.random()*( i + 1));
      temp = sentakusi[i];
      sentakusi[i] = sentakusi[r];
      sentakusi[r] = temp;
    };

//問題番号、選択肢配列、答えの場所、間違いの場所を送る。html関数を実行
makingquestion(item+1,sentakusi,sentakusi.indexOf(answer)+1,sentakusi.indexOf(miss1)+1,sentakusi.indexOf(miss2)+1);
});

function makingquestion(question_number,s_list,correct_number,miss1_number,miss2_number){
var contents ='<div class="center">'
+ '<div class="box">'
+ '<h1 class="mondai">'
+ question_number+'. この地名はなんて読む？'
+ '</h1>'
+ '<img src="./クイジー写真/'+(question_number-1) +'.png "alt="写真" id="picture_'+question_number+'">'
+ '<div class="btn">';

s_list.forEach(function display(sentakusi,item){
    //右に書いてあるものを左に代入せよというのが+=の意味である。
    //ulsクラスによって、リストの点を消している。
    contents +='        <p class="gyou"><li id="answerlist_' + question_number + '_' + (item + 1) +'"class="uls'
    //check関数に問題番号、選択された選択肢の番号、正解、不正解の番号を渡す
    + '"onclick="check(' + question_number  + ', ' +(item+1) +','+ correct_number + ', ' + miss1_number + ', '+ miss2_number + ')" >' + sentakusi + '</li></p>';   
});
//答えの箱を作る準備をしている。
 contents += '<p>'+'</p>'+
    //答えの箱
    '<div id="hide-'+question_number+'">'
    //正解、不正解の文字
    + '<div id="torf-'+question_number+'">'
    + '</div>'
    //正解発表の文章
    + '<div id="seikou-'+question_number+'">'   
    + '</div>'
    + '</div>'
//htmlにあるquestionにhtmlを導入している。
document.getElementById('question').insertAdjacentHTML('beforeend', contents);
};

//正解か不正解かを判定する
function check(question,pushnumber,correctnumber,false1_number,false2_number){
    var correct =document.getElementById('answerlist_'+question+'_'+correctnumber);
    var incorrect =document.getElementById('answerlist_'+question+'_'+pushnumber);
    var missing1 =document.getElementById('answerlist_' +question +'_'+false1_number);
    var missing2 =document.getElementById('answerlist_' +question +'_'+false2_number);
    var hide =document.getElementById('hide-'+question);
    var torf =document.getElementById('torf-'+question);
    var seikou3 =document.getElementById('seikou-'+question);
    var seikou2 =document.createTextNode('正解は「'+sentakusi[question-1][correctnumber-1]+'」です!');
    var seikou9 =document.createTextNode('江戸川区にあります。');
    var seikou =document.createTextNode('正解!');
    var sippai =document.createTextNode('不正解!');
    var picture=document.getElementById('picture_'+(question+1));

    //回答された際のクリックの無効化
    //回答欄の色付け
    correct.classList.add("blue","cantclick");
    incorrect.classList.add("red");
    missing1.classList.add("cantclick");
    missing2.classList.add("cantclick");
    hide.classList.add("hako");

    //正解時の処理
    if(correctnumber==pushnumber){
        torf.appendChild(seikou);
        torf.classList.add('yes');
    }else{
        //不正解時の処理
        torf.appendChild(sippai);
        torf.classList.add('tigai');
    };
    //問題９のみ表示される文章が特殊なので場合わけ
    if(question==9){
        seikou3.appendChild(seikou9);
        seikou3.classList.add('fonto');
    }else{
        seikou3.appendChild(seikou2);
        seikou3.classList.add('fonto');
    };

    //選択肢を押した際に次の問題が見えるようなスクロール。brockで動かしたい目標地点を指定、smoothは動き方
    //正し問題１０は次の問題がないため、場合わけが求められる。
    if(question<10){
    picture.scrollIntoView({behavior: 'smooth', block: 'end'});
    }else{
    hide.scrollIntoView({behavior: 'smooth', block: 'center'});
    };
};
  