<?php

// $dsn = 'mysql:host=mysql;dbname=laravel;charset=utf8;';
// $user = 'laravel';
// $password = 'password';

// try {
//     $db = new PDO($dsn, $user, $password);
//     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     echo '接続失敗: ' . $e->getMessage();
//     exit();
// }

$title_number = isset($_GET["question_id"]) ? $_GET["question_id"] : 1;

// $stmt = $db->query('SELECT * FROM questions JOIN choices ON questions . id = choices . question_id WHERE question_id =' . $title_number);
// $questions = $stmt->fetchAll();
// echo $title_number;
// var_dump($questions);
// echo count(array_unique(array($questions[0]["question_number"], $questions[3]["question_number"])));

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
            <a href="http://localhost/?question_id=2">クイズを変更する</a>
            <input type="hidden" name="question_id" value="2">
        </form>
    <?php else : ?>
        <form action="" method="GET">
            <a href="http://localhost/?question_id=1">クイズを変更する</a>
            <input type="hidden" name="question_id" value="1">
        </form>
    <?php endif; ?>

    <?php if ($title_number == 1) : ?>
        <h1 class="maintitle">ガチで東京の人しか解けない！＃東京の難読地名クイズ</h1>
    <?php else : ?>
        <h1 class="maintitle">ガチで広島の人しか解けない！＃広島の難読地名クイズ</h1>
    <?php endif; ?>

    <div class="center">
    <?php for ($i = 1; $i <= 10; $i++) : ?>
        <div class="box">
            <h2 class="mondai">
                <?= $i . '. この地名はなんて読む？' ?>
            </h2>
            <img src="./img/<?= $questions[$title_number]['question_id'] ?>/<?= $i -1?>.png" alt="写真" id="picture_<?= $questions[$title_number]["question_number"]?>">
            <div class="btn">
                <?php 
                $stmt2 = $db->query('SELECT choices . name, choices . valid FROM questions JOIN choices ON questions . id = choices . question_id WHERE question_id = ' . $title_number . ' AND question_number = ' . $i);
                $choices = $stmt2->fetchAll();
                $quiz_array = array($choices[0], $choices[1], $choices[2]);
                shuffle($quiz_array);
                $choices_result_0 = $quiz_array[0]['valid'];
                $choices_result_1 = $quiz_array[1]['valid'];
                $choices_result_2 = $quiz_array[2]['valid'];
                
                if($choices_result_0) {
                    $choices_result_2 +=2;
                } else if($choices_result_1) {
                    $choices_result_0 +=2;
                } else {
                    $choices_result_1 +=2;
                }
                ?>
                <p class="choices_box"><li id="choices_<?= $i?>_<?= $choices_result_0; ?>" class = "choices" onclick = "show_result(<?= $i?>,<?= $choices_result_0; ?>, this)"><?= $quiz_array[0]['name']; ?></li></p>
                <p class="choices_box"><li id="choices_<?= $i?>_<?= $choices_result_1; ?>" class = "choices" onclick = "show_result(<?= $i?>,<?= $choices_result_1; ?>, this)"><?= $quiz_array[1]['name']; ?></li></p>
                <p class="choices_box"><li id="choices_<?= $i?>_<?= $choices_result_2; ?>" class = "choices" onclick = "show_result(<?= $i?>,<?= $choices_result_2; ?>, this)"><?= $quiz_array[2]['name']; ?></li></p>
            </div>
            <div class = "result_box" id = "result_box_<?= $i?>">
                <p id = "torf_<?= $i?>"></p>
                <p id = "description_<?= $i?>">正解は<?= $choices[0]["name"] ?>です。</p>
            </div>
        </div>
    <?php endfor ?>
    </div>
    <script src="quizy.js"></script>
    
</body>
</html>