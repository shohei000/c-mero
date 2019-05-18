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
          <form class="form-horizontal" method="POST" action="/user/sign_up/store" autocomplete="off">
            {{ csrf_field() }}
            <div class="form-inner">
              <div class="form-item btn-tw btn-wrap">
                <a href="/auth/twitter" class="btn bg-tw btn--form"><span class="icon-tw">twitterで新規登録する</span></a>
              </div>
            <!--   <div class="form-item form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                {!!Form::text('name', $user->name, ['placeholder' => 'アカウント名', 'autocomplete' => 'off'])!!}
              </div> -->
              <div class="form-item form-group">
                <input placeholder="メールアドレス" autocomplete="off" name="email" type="text" class="{{ $errors->has('email') ? ' has-error' : '' }}" value="{{ old('email') }}">
                @if ($errors->has('email'))
                  <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                @endif
              </div>
              <div class="form-item form-group">
                <input placeholder="パスワード" autocomplete="off" name="password" type="password" value="" class="{{ $errors->has('password') ? ' has-error' : '' }}">
                @if ($errors->has('password'))
                  <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                @endif
              </div>
              <div class="form-item form-group">
                <div class="col-md-6">
                  <input placeholder="確認用パスワード" autocomplete="off" name="password_confirmation" type="password" value="">
                </div>
              </div>
              <div class="btn-wrap"><button type="submit" class="btn btn--blue btn--form">Eメールで新規登録する</button></div>
            </div>
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
    <div class="btn-wrap btn-wrap--mt"><a href="#loginPoint" class="btn btn--blue btn--form">無料で登録する</a></div>
  </section> 
@endsection
