<header class="header">
  <div class="inner-header">
    <h1 class="logo"><a href="/"><img src="/img/logo_text.svg" alt=""></h1>
    <nav class="g-nav">
    @if(Auth::check())
      <a href="/user/mypage" id="logout" class="my-navbar-item">マイページ</a>
      <a href="/user/logout" id="logout" class="my-navbar-item">ログアウト</a>
    @else
      <a class="my-navbar-item" href="/user/login">ログイン</a>
      ｜
      <a class="my-navbar-item" href="/user/sign_up">会員登録</a>
    @endif
    </nav>
  </div>
</header>