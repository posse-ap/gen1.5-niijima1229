<?php

$dsn = 'mysql:host=db;dbname=quizy;charset=utf8;';
$user = 'root';
$password = 'root';

try {
    $db = new PDO($dsn, $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo '接続失敗: ' . $e->getMessage();
    exit();
}

$title_number = isset($_GET["quiz_number"]) ? $_GET["quiz_number"] : 1;

$tokyo = $db->query('SELECT * from quiz WHERE quiz_title_number = ' . $title_number);
$tokyo_quizzes = $tokyo->fetchAll();
echo $title_number;

?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if ($title_number == 1) : ?>
        <title>ガチで東京の人しか解けない！＃東京の難読地名クイズ</title>
    <?php else : ?>
        <title>ガチで広島の人しか解けない！＃広島の難読地名クイズ</title>
    <?php endif; ?>
    <link rel="stylesheet" href="quizy.css">
</head>

<body>
    <?php if ($title_number == 1) : ?> 
        <form action="" method="GET">
            <a href="http://localhost/?quiz_number=2">クイズを変更する</a>
            <input type="hidden" name="quiz_number" value="2">
        </form>
    <?php else : ?>
        <form action="" method="GET">
            <a href="http://localhost/?quiz_number=1">クイズを変更する</a>
            <input type="hidden" name="quiz_number" value="1">
        </form>
    <?php endif; ?>

    <?php if ($title_number == 1) : ?>
        <h1 class="maintitle">ガチで東京の人しか解けない！＃東京の難読地名クイズ</h1>
    <?php else : ?>
        <h1 class="maintitle">ガチで広島の人しか解けない！＃広島の難読地名クイズ</h1>
    <?php endif; ?>
    <div class="center">
    <?php foreach ($tokyo_quizzes as $tokyo_quiz): ?>
        
            <div class="box">
                <h2 class="mondai">
                    <?= $tokyo_quiz["question_number"] . '. この地名はなんて読む？' ?>
                </h2>
                <img src="./img/<?= $tokyo_quiz['quiz_title_number'] ?>/<?= $tokyo_quiz["question_number"] -1?>.png" alt="写真" id="picture_<?= $tokyo_quiz["question_number"]?>">
                <div class="btn">
                    <?php 
                    $quiz_array = array([0,$tokyo_quiz["choice_1"]], [1,$tokyo_quiz["choice_2"]], [2,$tokyo_quiz["choice_3"]]);
                    shuffle($quiz_array);
                    ?>
                    <p class="choices_box"><li id="choices_<?= $tokyo_quiz["question_number"]?>_<?= $quiz_array[0][0] ?>" class = "uls" onclick = "show_result(<?= $tokyo_quiz['question_number']?>,<?= $quiz_array[0][0] ?>)"><?= $quiz_array[0][1] ?></li></p>
                    <p class="choices_box"><li id="choices_<?= $tokyo_quiz["question_number"]?>_<?= $quiz_array[1][0] ?>" class = "uls" onclick = "show_result(<?= $tokyo_quiz['question_number']?>,<?= $quiz_array[1][0] ?>)"><?= $quiz_array[1][1] ?></li></p>
                    <p class="choices_box"><li id="choices_<?= $tokyo_quiz["question_number"]?>_<?= $quiz_array[2][0] ?>" class = "uls" onclick = "show_result(<?= $tokyo_quiz['question_number']?>,<?= $quiz_array[2][0] ?>)"><?= $quiz_array[2][1] ?></li></p>
                </div>
                <div class = "result_box" id = "result_box_<?= $tokyo_quiz["question_number"]?>">
                    <p id = "torf_<?= $tokyo_quiz["question_number"]?>"></p>
                    <p id = "description_<?= $tokyo_quiz["question_number"]?>">正解は<?= $tokyo_quiz["choice_1"] ?>です。</p>
                </div>
            </div>
    <?php endforeach; ?>
    </div>
    <script src="quizy.js"></script>
    
</body>
</html>