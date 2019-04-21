@extends('layouts.app')

@section('content')
  <div class="contents contents--default">
    <div class="form-wrap">
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
            <div class="forgetPass">パスワードを忘れた方は<a href="/pass/">こちら</a></div>
          </div>
          <!-- <div class="btn-wrap"><a href="/user/sign_up" class="btn btn--blue btn--l"><span>新規登録</span></a></div> -->
        </form>

      </main>
    </div>
  </div>
@endsection
