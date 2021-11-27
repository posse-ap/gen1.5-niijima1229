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
    <link rel="stylesheet" href="{{ asset('/css/posse.css') }}">
    <script src="http://code.jquery.com/jquery-1.10.0.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="//unpkg.com/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.15/lodash.min.js"></script>
    <script src="//unpkg.com/flatpickr"></script>
    <script>

    </script>

    <title>Document</title>
</head>

<body>
    <header class="header">
        <div class="posse_title">
            <div class="posse_logo">
                <img src="/img/posselogoss.png" alt="logo" class="posse_logo_img">
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
                    <p class="time">{{$today_learning_time}}</p>
                    <p class="hour">hour</p>
                </div>
                <div class="badge bg-white text-dark studying_card">
                    <p class="period">Month</p>
                    <p class="time">{{$month_learning_time}}</p>
                    <p class="hour">hour</p>
                </div>
                <div class="badge bg-white text-dark studying_card">
                    <p class="period">Total</p>
                    <p class="time">{{$total_learning_time}}</p>
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
                    @foreach ($learning_languages as $learning_language)
                    <div><i class="fas fa-circle" style="color:{{$learning_language->color}}"></i>{{$learning_language->name}}</div>
                    @endforeach
                </div>
            </div>
            <div class="badge bg-white text-dark l_a_card">
                <h1 class="study_l_c">学習コンテンツ</h1>
                <!-- <img src="./img/conteguraff.png" alt="言語" class="doughnut_lang"> -->
                <div id="donutchart_cont" class="doughnut_lang"></div>
                <div class="kinds_cont_wrapper">
                    @foreach ($learning_contents as $learning_content)
                    <div><i class="fas fa-circle" style="color:{{$learning_content->color}}"></i>{{$learning_content->name}}</div>
                    @endforeach
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
                                <div class="checkbox-wrap">
                                    @foreach ($learning_contents as $learning_content)
                                    <label class="check_box_wrap">
                                        <input type="checkbox" name="learningcontent" value="{{$learning_content->id}}" class="check_box">
                                        <span>{{$learning_content->name}}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                            <h5>学習言語（複数選択可）</h5>
                            <div class="kinds_lang_box_wrapper">
                                <div class="checkbox-wrap">
                                    @foreach ($learning_languages as $learning_language)
                                    <label class="check_box_wrap">
                                        <input type="checkbox" name="learning_langage" value="{{$learning_language->id}}" class="check_box">
                                        <span>{{$learning_language->name}}</span>
                                    </label>
                                    @endforeach
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
                            <br>完了しました
                        </p>
                    </div>
                </div>
                <div class="calendar_modal">
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
    <script src="{{asset('/js/posse.js')}}"></script>
    <script src="{{asset('/js/calendar.js')}}"></script>
    <script>
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(draw_lang_chart);
        google.charts.setOnLoadCallback(draw_cont_chart);
        function draw_lang_chart() {
        var data = google.visualization.arrayToDataTable([
        ['language', 'Hours per Day'],
        @foreach($aggregate_learning_languages as $aggregate_learning_language)
        [{{$aggregate_learning_language->name}}, {{$aggregate_learning_language->total_language_learning_time}}],
        @endforeach

        ]);

        var options = {
        pieHole: 0.5,
        legend: 'none',
        colors:[
            @foreach ($learning_languages as $learning_language)
            '{{$learning_language->color}}' ,
            @endforeach
        ],
        width:'100%',
        height:'254',
        chartArea:{width:'100%',height:'100%',top:0},

        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart_lang'));
        chart.draw(data, options);

        function resizeHandler () {
        chart.draw(data, options);
        }
        if (window.addEventListener) {
        window.addEventListener('resize', resizeHandler, false);
        }
        else if (window.attachEvent) {
        window.attachEvent('onresize', resizeHandler);
        }

        var resize_graf =_.throttle(resizeHandler,5000)
        window.addEventListener("resize",resize_graf)

        }

        function draw_cont_chart() {
        var data = google.visualization.arrayToDataTable([
        ['content', 'percent'],
        @foreach($aggregate_learning_contents as $aggregate_learning_content)
        [{{$aggregate_learning_content->name}}, {{$aggregate_learning_content->total_content_learning_time}}],
        @endforeach

        ]);

        var options = {
        pieHole: 0.5,
        legend: 'none',
        colors:[
            @foreach ($learning_contents as $learning_content)
            '{{$learning_content->color}}' ,
            @endforeach
        ],
        width:'100%',
        height:'254',
        chartArea:{width:'100%',height:'100%',top:0}
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart_cont'));
        chart.draw(data, options);

        function resizeHandler () {
        chart.draw(data, options);
        }
        if (window.addEventListener) {
        window.addEventListener('resize', resizeHandler, false);
        }
        else if (window.attachEvent) {
        window.attachEvent('onresize', resizeHandler);
        }

        var resize_graf =_.throttle(resizeHandler,5000)
        window.addEventListener("resize",resize_graf)
        }

        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(draw_var_chart);
        function draw_var_chart() {
        var data = google.visualization.arrayToDataTable([
        ["day", "time"],
        @foreach ($per_day_learning_times as $per_day_learning_time)
        [{{$loop->iteration}}, {{$per_day_learning_time}}],
        @endforeach
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
        {

        calc: "stringify",
        sourceColumn: 1,
        type: "string",
        role: "annotation",

        }
        ]);

        var options = {
        legend: { position: 'none' },
        width:"100%",
        height: 400,
        bar: {groupWidth: "90%"},
        vAxis:{
        minValue:0,
        gridlines:{color: 'none', count:3},
        baselineColor: 'none',
        textPosition: 'out',
        ticks:[2,4,6,8]
        },
        };
        var chart = new google.charts.Bar(document.getElementById("columnchart_values"));
        chart.draw(data, google.charts.Bar.convertOptions(options));

        function resizeHandler () {
        chart.draw(data, options);
        }
        if (window.addEventListener) {
        // これだとresizeのたびに毎回イベント発火する
        // -> チャートを何回も作り直してしまう
        // -> ブラウザに負担がかかる
        // -> 100回イベントが起きたとて、1回だけ処理すればいい
        // -> throttleを使う
        // TODO
        // throttoleを使えるライブラリを探す(CDN)
        // resizeHandlerの発火回数を抑える
        window.addEventListener('resize', resizeHandler, false);
        }
        else if (window.attachEvent) {
        window.attachEvent('onresize', resizeHandler);
        }

        var resize_graf =_.throttle(resizeHandler,5000)
        window.addEventListener("resize",resize_graf)
        }
    </script>
    {{-- <script src="{{asset('/js/graf.js')}}"></script> --}}
</body>

</html>
