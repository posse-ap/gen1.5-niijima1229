<html>
  <head>
    <title>@yield('title')</title>
    <style>
      body {font-size: 16pt; color: #999; }
      h1 {font-size: 100pt; text-align:right; color:#eee; margin: -40px 0px -50px 0px; }
      ul {font-size:12pt;}
      hr {margin: 25px 100px; border-top: 1px dashed #ddd;}
      .menutitle {font-size: 14pt; font-weight: bold; margin: 0px;}
      .content {margin: 10px;}
      .footer {text-align:right; font-size: 10pt; margin: 10px; border-bottom: solid 1px #ccc; color: #ccc;}
    </style>
  </head>
  <body>
    <h1>@yield('title')</h1>
    @section('menubar')
    <h2 class="menutitle">※メニュー</h2>
    <ul>
      <li>@show</li>
    </ul>
    <hr size="1">
    <div class="content">
      @yield('content')
    </div>
    <div class="footer">
      @yield('footer')
    </div>
  </body>
</html>