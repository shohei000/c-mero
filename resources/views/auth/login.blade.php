@extends('layouts.app')

@section('content')
  <h1 class="leadCopy">最短3分で、驚くほど簡単に<br>企画ライブの特設ページが作れる！</h1>
  <div class="freee"><span>完全無料！</span></div>
  <div id="dmeoAuth" class="contents contents--default">
    <div class="dmeoAuthInner">
      <div class="demoIphone">
        <img src="/img/iPhone-6.png" alt="">
        <div class="demoMovie">
          <video 
            src="/demo/movie/demo.mp4"
            autoplay
            loop
            muted
            playsinline>
          </video>
        </div>
      </div>
      <div id="loginPoint" class="form-wrap form-wrap--demo">
        <h2 class="form-ttl"><img src="/img/logo_text.svg" alt=""></h2>
        <main class="form-area">
          <form class="form-horizontal" method="POST" action="/user/login">
            {{ csrf_field() }}
            <div class="form-inner">
              <div class="form-item btn-tw btn-wrap">
                <a href="/auth/twitter" class="btn bg-tw btn--form"><span class="icon-tw">twitterでログインする</span></a>
              </div>
              <div class="form-item form-group">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' has-error' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="メールアドレス">
                @if ($errors->has('email'))
                  <span class="help-block"><strong>ログインIDとパスワードが一致していません。</strong></span>
                @endif
              </div>
              <div class="form-item form-group">
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' has-error' : '' }}" name="password" required placeholder="パスワード">
                @if ($errors->has('password'))
                  <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                @endif
              </div>
              <div class="btn-wrap btn-wrap--mt"><button type="submit" class="btn btn--blue btn--form">Eメールでログインする</button></div>
              <div class="forgetPass">パスワードを忘れた方は<a href="/password/reset">こちら</a></div>
            </div>
            <!-- <div class="btn-wrap"><a href="/user/sign_up" class="btn btn--blue btn--l"><span>新規登録</span></a></div> -->
          </form>
        </main>
      </div>
    </div>
    <a href="/demo/index.html" target="_blank" class="demoBtn">実際に完成するデモページを見る ＞</a>
  </div>
  <section class="make">
    <div class="makeitle">特設ページの作り方【3ステップ】</div>
    <div class="step">
      <div class="stepImg">
        <img src="/demo/img/step1.png" alt="">
        <div class="stepInfo">①「イベントを作成する」ボタンをクリック</div>
      </div>
      <div class="stepImg">
        <img src="/demo/img/step2.png" alt="">
        <div class="stepInfo">②入力フォームが表示される</div>
      </div>
      <div class="stepImg">
        <img src="/demo/img/step3.png" alt="">
        <div class="stepInfo">③イベントの情報を入力して「作成」ボタンをクリック！</div>
      </div>
    </div>
    <a href="/demo/index.html" target="_blank" class="demoBtn">実際に完成するデモページを見る ＞</a>
    <div class="btn-wrap btn-wrap--mt"><a href="#loginPoint" class="btn btn--blue btn--form">ログインする</a></div>
  </section> 
@endsection
