<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>c-mero　｜　企画ライブに命を吹き込む！</title>
	

	@yield('ogp')
  @yield('styles')
  <link rel="stylesheet" href="/css/style.css">

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-140418706-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-140418706-1');
  </script>
</head>
<body>

<div id="app">
	<!-- <div class="loading"><h1 class="logoFrame"><img src="/img/logo_frame.svg" alt=""></h1></div> -->
@include('components.header')
<div class="main">
  @yield('content')
</div>
</div>

<script src="/vendor/js/jquery-3.3.1.min.js"></script>
<script src="/js/common.js"></script>
@yield('scripts')
</body>
</html>