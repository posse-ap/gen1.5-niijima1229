<?php

$dsn = 'mysql:host=mysql;dbname=laravel;charset=utf8;';
$user = 'laravel';
$password = 'password';

try {
    $db = new PDO($dsn, $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo '接続失敗: ' . $e->getMessage();
    exit();
}

$title_number = isset($_GET["question_id"]) ? $_GET["question_id"] : 1;

// $stmt = $db->query('SELECT * FROM questions JOIN choices ON questions . id = choices . question_id WHERE question_id =' . $title_number);
// $questions = $stmt->fetchAll();

?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if ($id == 1) : ?>
        <title>ガチで東京の人しか解けない！＃東京の難読地名クイズ</title>
    <?php else : ?>
        <title>ガチで広島の人しか解けない！＃広島の難読地名クイズ</title>
    <?php endif; ?>
    <link rel="stylesheet" href="{{ asset('/css/quizy.css') }}">
</head>

<body>
    <?php if ($id == 1) : ?> 
        <form action="" method="GET">
            <a href="">クイズを変更する</a>
            <input type="hidden" name="question_id" value="2">
        </form>
    <?php else : ?>
        <form action="" method="GET">
            <a href="">クイズを変更する</a>
            <input type="hidden" name="question_id" value="1">
        </form>
    <?php endif; ?>

    <?php if ($id == 1) : ?>
        <h1 class="maintitle">ガチで東京の人しか解けない！＃東京の難読地名クイズ</h1>
    <?php else : ?>
        <h1 class="maintitle">ガチで広島の人しか解けない！＃広島の難読地名クイズ</h1>
    <?php endif; ?>

    <div class="center">
    @for ($i = 1; $i <= 2; $i++)
        <div class="box">
            <h2 class="mondai">
                <?= $i . '. この地名はなんて読む？' ?>
            </h2>
            <?=$id?>
            {!! asset('/img/{$title_number}/{$i -1}.png') !!}
            {!! asset('/img/<?=$id?>/0.png') !!}
            <img src="asset('/img/{$id}/<?= $i -1?>.png')" alt="写真" id="picture_<?= $i?>">
            <div class="btn">
                <?php 
                // $stmt = $db->query('SELECT choices . name, choices . valid FROM questions JOIN choices ON questions . id = choices . question_id WHERE question_id = ' . $title_number . ' AND question_number = ' . $i);
                $stmt = $db->query('SELECT choices . name, choices . valid FROM questions JOIN choices ON questions . id = choices . question_id where question_id = 2 and question_number = ' . $i);
                $choices = $stmt->fetchAll();
                // $choices = DB::table('questions')->join('choices', 'questions.id', '=', 'choices_id')->where('question_id', '=', $id)->where('question_number', '=', $i)->get('choices.name','choices.valid');
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
    @endfor
    </div>
    <script src="{{ asset('/js/quizy.js') }}"></script>
    
</body>
</html>