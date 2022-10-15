<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .imgs {
            width: 100%;
            height: 100px;
            object-fit: cover;
            overflow: hidden;
        }
    </style>
    <title>Document</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <img src="/img/posselogoss.png" alt="">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                </ul>
                <form class="d-flex">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Activity</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Organisation</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Sponsors</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">加入希望の方へ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">企業の方へ</a>
                        </li>
                    </ul>
                    <button class="btn btn-outline-success" type="submit">友達追加</button>
                </form>
            </div>
        </div>
    </nav>
    <img src="https://blog.posse-ap.com/wp-content/plugins/snow-monkey-blocks/dist/img/photos/line_52269528648064.jpg"
        alt="" class="imgs">
    <div class="mx-2">

        <div class="text-center">
            <p>POSSEメンバーが作成した記事をまとめています。</p>
        </div>
    </div>
    <div class="d-flex justify-content-between mx-5">
        @foreach ($news as $news)
            <a class="card" style="width: 18rem;" href="{{ route('news_detail', ['id' => $news['id']]) }}">
                <img src="{{ $news['thumbnail_url'] }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text">{{ $news['title'] }}</p>
                    <small class="mt-2">{{ $news['text'] }}</small>
                    <div class="d-flex">
                        <img src="{{ $news['author']['picture_url'] }}" alt="" style="width:20px; height:20px;">
                        <small>{{ $news['author']['name'] }}</small>
                        <small>{{ $news['date'] }}</small>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</body>

</html>
