<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ToDo App</title>
  @yield('styles')
  <link rel="stylesheet" href="/css/style.css">
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
@yield('scripts')
</body>
</html>