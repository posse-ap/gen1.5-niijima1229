<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.1/chart.min.js"
        integrity="sha512-O2fWHvFel3xjQSi9FyzKXWLTvnom+lOYR/AUEThL/fbP4hv1Lo5LCFCGuTXBRyKC4K4DJldg5kxptkgXAzUpvA==" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css"
        integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="{{ asset('/css/posse.css') }}">
    <script src="http://code.jquery.com/jquery-1.10.0.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="//unpkg.com/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.15/lodash.min.js"></script>
    <script src="//unpkg.com/flatpickr"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .error-container {
            display: none;
        }
        .error-color{
            padding-top: 200px;
            color: #f4bd67;
        }

        .error-mark{
            width: 60px;
            height: 60px;
            background-color: #f4bd67;
            color: #fff;
            border-radius: 50%;
            font-size: 40px;
        }

        .error-text{
            font-size: 13px;
        }
    </style>
    <title>Document</title>
</head>

<body class="container-fluid">
    <nav class="navbar navbar-light bg-white">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="/img/posselogoss.png" alt="logo" class="posse_logo_img">
                <span class="posse_week" style="color:#97b9d1">
                    4th week
                </span>
            </a>
            <a href="{{route('user_edit')}}">編集</a>
            <button type="button" class="shadow-lg p-3 btn_submit d-none d-md-block border-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                記録・投稿
            </button>
        </div>
    </nav>

    <main class="mt-3 container-fluid">
        <div class="row d-flex flex-wrap mx-md-5">
            <div class="col-lg col-md-12 d-flex flex-column justify-content-between container-fluid mb-5 mb-lg-0">
                <div class="row m-0 mb-2 justify-content-between">
                    <div style="width:30%" class="card text-center">
                        <div class="card-body px-0">
                            <p style="color: #0f71bc" class="card-text">Today</p>
                            <h5 class="card-title fs-3">{{ $today_learning_time }}</h5>
                            <p style="color:#97b9d1" class="card-text">hour</p>
                        </div>
                    </div>
                    <div style="width:30%" class="card text-center">
                        <div class="card-body px-0">
                            <p style="color: #0f71bc" class="card-text">Month</p>
                            <h5 class="card-title fs-3">{{ $month_learning_time }}</h5>
                            <p style="color:#97b9d1" class="card-text">hour</p>
                        </div>
                    </div>
                    <div style="width:30%" class="card text-center">
                        <div class="card-body px-0">
                            <p style="color: #0f71bc" class="card-text">Total</p>
                            <h5 class="card-title fs-3">{{ $total_learning_time }}</h5>
                            <p style="color:#97b9d1" class="card-text">hour</p>
                        </div>
                    </div>
                </div>
                <div style="background-color:white;" class="rounded">
                    {{-- <div id="columnchart_values" class="d-flex align-items-center rounded"></div> --}}
                    <canvas id="monthChart"></canvas>
                </div>
            </div>
            <div class="col-lg col-md-12 container-fluid">
                <div class="row h-100 m-0 justify-content-between">
                    <div style="width:48%;" class="col-6 card">
                        <h5 class="mt-4 card-title">学習言語</h5>
                        <div class="my-5" id="donutchart_lang"></div>
                        <div class="card-body d-flex flex-wrap">
                            @foreach ($learning_languages as $learning_language)
                                <div class="me-2"><i class="fas fa-circle"
                                        style="color:{{ $learning_language->color }}"></i>{{ $learning_language->name }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div style="width:48%;" class="col-6 card">
                        <h5 class="mt-4 card-title">学習コンテンツ</h5>
                        <div class="my-5" id="donutchart_cont"></div>
                        <div class="card-body">
                            @foreach ($learning_contents as $learning_content)
                                <div class="me-2"><i class="fas fa-circle"
                                        style="color:{{ $learning_content->color }}"></i>{{ $learning_content->name }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="container mt-2">
        <div class="mx-auto text-center">
            <i class="fas fa-chevron-left"></i>
            <span class="study_date fs-5">2020年 10月</span>
            <i class="fas fa-chevron-right"></i>
        </div>
        <div class="mx-auto text-center">
            <button type="button" class="shadow-lg p-3 btn_submit border-0 d-md-none" data-bs-toggle="modal" data-bs-target="#exampleModal">
                記録・投稿
            </button>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable modal-fullscreen-md-down">
            <div class="modal-content border-0 mt-5 mt-md-0 modal-rounded">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal_default">
                    <form  class="container-fluid px-5 modal_default">
                        <div class="row">
                            <div class="col-lg col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">学習日</label>
                                    <input type="date" id="calendar" class="form-control bg-light border-0" name="learning_date">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">学習コンテンツ</label>
                                    <div class="d-flex flex-wrap">
                                        <p class="fs-4 m-2">
                                            @foreach ($learning_contents as $learning_content)
                                            <label class="badge rounded-pill bg-light text-dark checkbox-wrap">
                                                <input type="checkbox" name="learning_content_id" value="{{$learning_content->id}}" class="check_box">
                                                <span class="fw-light">{{$learning_content->name}}</span>
                                            </label>
                                            @endforeach
                                        </p>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">学習言語</label>
                                    <div class="d-flex flex-wrap">
                                        @foreach ($learning_languages as $learning_language)
                                            <p class="fs-4 m-2">
                                                <label class="badge rounded-pill bg-light text-dark checkbox-wrap">
                                                    <input type="checkbox" name="learning_langage_id" value="{{$learning_language->id}}" class="check_box">
                                                    <span class="fw-light">{{$learning_language->name}}</span>
                                                </label>
                                            </p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">学習時間</label>
                                    <input type="number" class="form-control bg-light border-0" name="learning_time" id="learning_time">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Twitter用コメント</label>
                                    <textarea id="twitter_comment" class="form-control bg-light border-0" rows="9"></textarea>
                                </div>
                                <label class="checkbox-wrap">
                                    <input type="checkbox" class="check_box">
                                    <span>Twitterに投稿する</span>
                                </label>
                            </div>
                        </div>
                        <div style="text-align: center">
                            <button type="submit" onclick="submit_loading()" id="submit_btn" class="shadow-lg p-3 px-5 my-3  mx-auto btn_submit border-0" >
                                記録・投稿
                            </button>
                        </div>
                    </form>
                </div>
                <div id="modal_loading" class="modal-body container-fluid modal-loading">
                    <div class="mx-auto text-center">
                        <div class="spinner-border fa-3x loading_spiner" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="container-fluid modal-done modal-body" id="modal_done">
                    <div class="mx-auto text-center">
                        <div class="done_inner">
                            <p class="awesome">AWESOME!</p>
                            <i class="fas fa-check-circle fa-5x checkmark_large" style="color:#BEE361"></i>
                            <p class="r_p_txt">記録・投稿
                                <br>完了しました
                            </p>
                        </div>
                    </div>
                </div>
                <div class="error-container text-center" id="modal_error">
                    <p class="error-color mb-1">ERROR</p>
                    <p class="error-mark mx-auto mb-3">!</p>
                    <p class="error-text">一時的にご利用できない状態です。<br>しばらく経ってから<br>再度アクセスしてください。</p>
                </div>
            </div>
        </div>
    </div>
    <script>
        const submit_btn = document.getElementById("submit_btn");
        const modal_default = document.getElementById("modal_default");
        const modal_loading = document.getElementById("modal_loading");
        const modal_done = document.getElementById("modal_done");
        const modal_error = document.getElementById("modal_error");
        var study_time = $('#submit_btn');
        study_time.on('click', function () {
            modal_default.style.display = "none";
            modal_loading.style.display = "block";
            var learning_content_ids = $('input[name=learning_content_id]:checked').map(function(){
                return $(this).val();
            }).get();
            var learning_langage_ids = $('input[name=learning_langage_id]:checked').map(function(){
                return $(this).val();
            }).get();
            var study_time = document.getElementById("learning_time").value;
            var calendar = document.getElementById("calendar").value;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/study_time_post',
              //routeの記述
                type: 'POST',
              //受け取り方法の記述（GETもある）
                data: {
                    learning_content_ids: learning_content_ids,
                    learning_language_ids: learning_langage_ids,
                    study_time: study_time,
                    study_date: calendar,
                }
            }) // Ajaxリクエストが成功した場合
            .done(function () {
                modal_loading.style.display = "none";
                modal_done.style.display = "block";
                // var total_study_time = $('#total_study_time_week' + week_id);
                // var assignment_time = parseInt($('#assignment_time_week' + week_id).val());
                // var review_time = parseInt($('#review_time_week' + week_id).val());
                // total_study_time.text(assignment_time + review_time);
            }) // Ajaxリクエストが失敗した場合
            .fail(function (data, xhr, err) {
              //ここの処理はエラーが出た時にエラー内容をわかるようにしておく。
              //とりあえず下記のように記述しておけばエラー内容が詳しくわかります。笑
                modal_loading.style.display = "none";
                modal_error.style.display = "block";
                console.log(err);
                console.log(xhr);
            });
            return false;
        });
    </script>
    <script src="{{ asset('/js/posse.js') }}"></script>
    <script src="{{ asset('/js/calendar.js') }}"></script>
    <script>
        var monthChart = document.getElementById("monthChart");
        var ctx = monthChart.getContext("2d");

        let gradient = ctx.createLinearGradient(0,0,0,300);
        gradient.addColorStop(0, '#21BDDE');
        gradient.addColorStop(1, '#2A54EF');
        ctx.fillStyle = gradient;
        ctx.fillRect(0,0,0,0);

        var monthChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    @foreach ($per_day_learning_times as $per_day_learning_time)
                    {{ $loop->iteration }},
                    @endforeach
                ],
                datasets: [{
                    label: [],
                    data: [
                        @foreach ($per_day_learning_times as $per_day_learning_time)
                        {{ $per_day_learning_time }},
                        @endforeach
                    ],
                    backgroundColor: [
                        gradient,
                    ],
                    borderRadius:30,
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false,
                    },
                },
                scales: {
                    y: {
                        grid: {
                            display: false,
                        },
                    },
                    x: {
                        grid: {
                            display: false,
                        },
                        ticks: {
                            min: 2,
                            stepSize: 2
                        }
                    }
                },
            }
        });


        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(draw_lang_chart);
        google.charts.setOnLoadCallback(draw_cont_chart);

        function draw_lang_chart() {
            var data = google.visualization.arrayToDataTable([
                ['language', 'Hours per Day'],
                @foreach ($aggregate_learning_languages as $aggregate_learning_language)
                    [{{ $aggregate_learning_language->name }}, {{ $aggregate_learning_language->total_language_learning_time }}],
                @endforeach

            ]);

            var options = {
                pieHole: 0.5,
                legend: 'none',
                colors: [
                    @foreach ($learning_languages as $learning_language)
                        '{{ $learning_language->color }}' ,
                    @endforeach
                ],
                width: '100%',
                height: '254',
                chartArea: {
                    width: '100%',
                    height: '100%',
                    top: 0
                },

            };

            var chart = new google.visualization.PieChart(document.getElementById('donutchart_lang'));
            chart.draw(data, options);

            function resizeHandler() {
                chart.draw(data, options);
            }
            if (window.addEventListener) {
                window.addEventListener('resize', resizeHandler, false);
            } else if (window.attachEvent) {
                window.attachEvent('onresize', resizeHandler);
            }

            var resize_graf = _.throttle(resizeHandler, 5000)
            window.addEventListener("resize", resize_graf)

        }

        function draw_cont_chart() {
            var data = google.visualization.arrayToDataTable([
                ['content', 'percent'],
                @foreach ($aggregate_learning_contents as $aggregate_learning_content)
                    [{{ $aggregate_learning_content->name }}, {{ $aggregate_learning_content->total_content_learning_time }}],
                @endforeach

            ]);

            var options = {
                pieHole: 0.5,
                legend: 'none',
                colors: [
                    @foreach ($learning_contents as $learning_content)
                        '{{ $learning_content->color }}' ,
                    @endforeach
                ],
                width: '100%',
                height: '254',
                chartArea: {
                    width: '100%',
                    height: '100%',
                    top: 0
                }
            };

            var chart = new google.visualization.PieChart(document.getElementById('donutchart_cont'));
            chart.draw(data, options);

            function resizeHandler() {
                chart.draw(data, options);
            }
            if (window.addEventListener) {
                window.addEventListener('resize', resizeHandler, false);
            } else if (window.attachEvent) {
                window.attachEvent('onresize', resizeHandler);
            }

            var resize_graf = _.throttle(resizeHandler, 5000)
            window.addEventListener("resize", resize_graf)
        }

        // google.charts.load('current', {
        //     'packages': ['bar']
        // });
        // google.charts.setOnLoadCallback(draw_var_chart);

        // function draw_var_chart() {
        //     var data = google.visualization.arrayToDataTable([
        //         ["day", "time"],
        //         @foreach ($per_day_learning_times as $per_day_learning_time)
        //             [{{ $loop->iteration }}, {{ $per_day_learning_time }}],
        //         @endforeach
        //     ]);

        //     var view = new google.visualization.DataView(data);
        //     view.setColumns([0, 1,
        //         {

        //             calc: "stringify",
        //             sourceColumn: 1,
        //             type: "string",
        //             role: "annotation",

        //         }
        //     ]);

        //     var options = {
        //         legend: {
        //             position: 'none'
        //         },
        //         width: "100%",
        //         height: 400,
        //         bar: {
        //             groupWidth: "90%"
        //         },
        //         vAxis: {
        //             minValue: 0,
        //             gridlines: {
        //                 color: 'none',
        //                 count: 3
        //             },
        //             baselineColor: 'none',
        //             textPosition: 'out',
        //             ticks: [2, 4, 6, 8]
        //         },
        //     };
        //     var chart = new google.charts.Bar(document.getElementById("columnchart_values"));
        //     chart.draw(data, google.charts.Bar.convertOptions(options));

        //     function resizeHandler() {
        //         chart.draw(data, options);
        //     }
        //     if (window.addEventListener) {

        //         window.addEventListener('resize', resizeHandler, false);
        //     } else if (window.attachEvent) {
        //         window.attachEvent('onresize', resizeHandler);
        //     }

        //     var resize_graf = _.throttle(resizeHandler, 5000)
        //     window.addEventListener("resize", resize_graf)
        // }
    </script>
    {{-- <script src="{{asset('/js/graf.js')}}"></script> --}}
</body>

</html>
