<?php

require('./dbconnect.php');

$stmt = $db->query(
    "SELECT learning_time 
    FROM learning_record 
    WHERE DATE(learning_date) = DATE(now()) 
    ORDER BY learning_date;"
);

$today_learning_time = $stmt->fetch(PDO::FETCH_COLUMN) ?: 0;

$stmt = $db->query(
    "SELECT SUM(learning_time) 
    FROM learning_record 
    WHERE DATE_FORMAT(learning_date, '%Y%m') = DATE_FORMAT(now(), '%Y%m') 
    GROUP BY learning_date;"
);

$month_learning_time = $stmt->fetch(PDO::FETCH_COLUMN) ?: 0;

$day_learning_time = $stmt->fetchAll();


$stmt = $db->query(
    "SELECT SUM(learning_time) 
    FROM learning_record;"
);

$total_learning_time = $stmt->fetch(PDO::FETCH_COLUMN) ?: 0;

$stmt = $db->query(
    "SELECT learning_languages . name, SUM(learning_time) AS language_learning_time, color 
    FROM language_learning_records 
    JOIN learning_languages 
    ON language_id = learning_languages . id 
    GROUP BY language_id;"
);

$learning_languages = $stmt->fetchAll();

var_dump($learning_languages[0]);

?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css"
        integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="posse.css">
    <script src="http://code.jquery.com/jquery-1.10.0.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="//unpkg.com/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.15/lodash.min.js"></script>
    <!-- カスタムテーマ -->
    <!-- <link rel="stylesheet" href="//unpkg.com/flatpick/dist/themes/airbnb.css"> -->
    <script src="//unpkg.com/flatpickr"></script>
    <!-- 日本語の言語ファイル -->
    <!-- <script src="//unpkg.com/flatpickr/dist/l10n/ja.js"></script> -->
    <!-- <script src="./lib/picker.js"></script>
    <script src="./lib/picker.date.js"></script>
    
    <script src="./lib/legacy.js"></script>
    <script src="./lib/picker.time.js"></script> -->

    <title>Document</title>
</head>

<body>
    <header class="header">
        <div class="posse_title">
            <div class="posse_logo">
                <img src="./img/posselogoss.png" alt="logo" class="posse_logo_img">
            </div>
            <div class="posse_week">
                <span>4th week</span>
            </div>
        </div>
        <span class="shadow-lg p-3 btn_submit" id="openModal">
            記録・投稿
        </span>
    </header>

    <main class="main">
        <div class="studying_hour">
            <div class="studying_letter">
                <div class="badge bg-white text-dark studying_card">
                    <p class="period">Today</p>
                    <p class="time"><?= $today_learning_time; ?></p>
                    <p class="hour">hour</p>
                </div>
                <div class="badge bg-white text-dark studying_card">
                    <p class="period">Month</p>
                    <p class="time"><?= $month_learning_time; ?></p>
                    <p class="hour">hour</p>
                </div>
                <div class="badge bg-white text-dark studying_card">
                    <p class="period">Total</p>
                    <p class="time"><?= $total_learning_time; ?></p>
                    <p class="hour">hour</p>
                </div>
            </div>
            <div class="bar_graf_wrapper">
                <!-- <img src="./img/leftgraff.png" alt="bar_graf" class="rounded bar_graf"> -->
                <div id="columnchart_values" class="rounded bar_graf"></div>
            </div>
        </div>
        <div class="studying_graf">
            <div class="badge bg-white text-dark l_a_card">
                <h1 class="study_l_c">学習言語</h1>
                <div id="donutchart_lang" class="doughnut_lang"></div>

                <div class="kinds_lang_wrapper">
                    <div><i class="fas fa-circle js_circle"></i>JavaScript</div>
                    <div><i class="fas fa-circle css_circle"></i>CSS</div>
                    <div><i class="fas fa-circle php_circle"></i>PHP</div>
                    <div><i class="fas fa-circle html_circle"></i>HTML</div>
                    <div><i class="fas fa-circle laravel_circle"></i>Laravel</div>
                    <div><i class="fas fa-circle sql_circle"></i>SQL</div>
                    <div><i class="fas fa-circle shell_circle"></i>SHELL</div>
                    <div><i class="fas fa-circle wealth_circle"></i>情報システム基礎知識(その他)</div>
                </div>
            </div>
            <div class="badge bg-white text-dark l_a_card">
                <h1 class="study_l_c">学習コンテンツ</h1>
                <!-- <img src="./img/conteguraff.png" alt="言語" class="doughnut_lang"> -->
                <div id="donutchart_cont" class="doughnut_lang"></div>
                <div class="kinds_cont_wrapper">
                    <div><i class="fas fa-circle dot_circle"></i>ドットインストール</div>
                    <div><i class="fas fa-circle n_yobi_circle"></i>N予備校</div>
                    <div><i class="fas fa-circle posse_circle"></i>POSSE課題</div>
                </div>
            </div>
        </div>



        <!-- モーダルエリアここから -->
        <section id="modalArea" class="modalArea">
            <div id="modalBg" class="modalBg"></div>
            <div class="modalWrapper" id="modal_inner">
                <div class="close-btn" id="closeModal">
                    <span class="fa-stack">
                        <i class="fas fa-stack-2x fa-circle" style="color:#F5F4F8"></i>
                        <i class="fas fa-stack-1x fa-times"></i>
                    </span>
                </div>
                <div class="default_modal" id="default_modal">
                    <div class="popup_form">
                        <div class="popup_left">
                            <h5>学習日</h5>
                            <!-- <input type="text" id="calendar" class="learning_date_time" data-mindate=today  placeholder="Select Date.." readonly="readonly" onclick="calendar()"> -->
                            <input type="text" id="calendar" class="learning_date_time">
                            <!-- <input id="demo001"  type="text" placeholder="クリックしてください"> -->
                            <h5>学習コンテンツ（複数選択可）</h5>
                            <div class="lang_cont_wrap">
                                <!-- <div class="check_box_wrap"><input type="checkbox" class="check_box"><span>N予備校</span></div>
                                    <div class="check_box_wrap"><input type="checkbox"><span>ドットインストール</span></div>
                                    <div class="check_box_wrap"><input type="checkbox"><span>POSSE課題</span></div> -->
                                <div class="checkbox-wrap">
                                    <label class="check_box_wrap">
                                        <input type="checkbox" name="cont" value="checkbox1" class="check_box">
                                        <span>N予備校</span>
                                    </label>

                                    <label class="check_box_wrap">
                                        <input type="checkbox" name="cont" value="checkbox2" class="check_box">
                                        <span>ドットインストール</span>
                                    </label>

                                    <label class="check_box_wrap">
                                        <input type="checkbox" name="cont" value="checkbox3" class="check_box">
                                        <span>POSSE課題</span>
                                    </label>
                                </div>
                            </div>
                            <h5>学習言語（複数選択可）</h5>
                            <div class="kinds_lang_box_wrapper">
                                <!-- <div class="check_box_wrap"><input type="checkbox" name="" id=""><span></span>HTML</div>
                                    <div class="check_box_wrap"><input type="checkbox" name="" id=""><span></span>CSS</div>
                                    <div class="check_box_wrap"><input type="checkbox" name="" id=""><span></span>JavaScript</div>
                                    <div class="check_box_wrap"><input type="checkbox" name="" id=""><span></span>PHP</div>
                                    <div class="check_box_wrap"><input type="checkbox" name="" id=""><span></span>Laravel</div>
                                    <div class="check_box_wrap"><input type="checkbox" name="" id=""><span></span>SQL</div>
                                    <div class="check_box_wrap"><input type="checkbox" name="" id=""><span></span>SHELL</div>
                                    <div class="check_box_wrap"><input type="checkbox" name="" id=""><span></span>情報システム基礎知識（その他）</div> -->
                                <div class="checkbox-wrap">
                                    <label class="check_box_wrap">
                                        <input type="checkbox" name="lang" value="checkbox1" class="check_box">
                                        <span>HTML</span>
                                    </label>

                                    <label class="check_box_wrap">
                                        <input type="checkbox" name="lang" value="checkbox2" class="check_box">
                                        <span>CSS</span>
                                    </label>

                                    <label class="check_box_wrap">
                                        <input type="checkbox" name="lang" value="checkbox3" class="check_box">
                                        <span>JavaScript</span>
                                    </label>
                                    <label class="check_box_wrap">
                                        <input type="checkbox" name="lang" value="checkbox4" class="check_box">
                                        <span>PHP</span>
                                    </label>

                                    <label class="check_box_wrap">
                                        <input type="checkbox" name="lang" value="checkbox5" class="check_box">
                                        <span>Laravel</span>
                                    </label>

                                    <label class="check_box_wrap">
                                        <input type="checkbox" name="lang" value="checkbox6" class="check_box">
                                        <span>SQL</span>
                                    </label>
                                    <label class="check_box_wrap">
                                        <input type="checkbox" name="lang" value="checkbox7" class="check_box">
                                        <span>SHELL</span>
                                    </label>

                                    <label class="check_box_wrap">
                                        <input type="checkbox" name="lang" value="checkbox8" class="check_box">
                                        <span>情報システム基礎知識（その他）</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="popup_right">
                            <h5>学習時間</h5>
                            <input type="text" class="learning_date_time">
                            <h5>Twitter用コメント</h5>
                            <textarea id="twitter_comment" cols="140" maxlength="140"
                                class="twitter_comment"></textarea>
                            <div class="checkbox-wrap">
                                <label class="twitter_check"><input type="checkbox" name="twitter"
                                        value="checkbox_twitter" class="check_box">
                                    <span>Twitterに投稿する</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="btn_submit_modal_wrap">
                        <i class="shadow-lg p-3 btn_submit_modal" id="r_p_done_btn" onclick="loading()">
                            記録・投稿
                        </i>
                    </div>
                </div>
                <div class=" justify-content-center loading" id="loading">
                    <div class="spinner-border fa-3x loading_spiner" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <div class="r_p_modal" id="r_p_modal">
                    <!-- <div class="close-btn" id="closeModal_rp" onclick="">
                        <span class="fa-stack">
                        <i class="fas fa-stack-2x fa-circle" style="color:#F5F4F8"></i>
                        <i class="fas fa-stack-1x fa-times"></i>
                        </span>
                    </div> -->
                    <div class="done_inner">
                        <p class="awesome">AWESOME!</p>
                        <i class="fas fa-check-circle fa-5x checkmark_large" style="color:#BEE361"></i>
                        <p class="r_p_txt">記録・投稿
                            <br>完了しました</p>
                    </div>
                </div>
                <div class="calendar_modal" id="calendar_modal">
                    <div id="calendar_year_month"></div>
                    <div id="calendar_date"></div>
                    <div></div>
                </div>
            </div>
            <!-- <div class="modal_calendar_wrapper">

            </div> -->
            </div>
        </section>
        <!-- モーダルエリアここまで -->

    </main>
    <footer class="footer">
        <i class="fas fa-chevron-left"></i>
        <p class="study_date">2020年 10月</p>
        <i class="fas fa-chevron-right"></i>
    </footer>
    <div class="btn_submit_s_wrap">
        <span class="shadow-lg p-3 btn_submit_s" id="openModal-s">
            記録・投稿
        </span>
    </div>
    <script src="posse.js"></script>
    <script src="calendar.js"></script>
    <script src="graf.php" type = "text/javascript"></script>
</body>

</html>