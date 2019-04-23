@extends('layouts.app')

@section('content')
  <div class="contents contents--default">
    <div class="form-wrap">
      <h2 class="form-ttl"><img src="/img/logo_text.svg" alt=""></h2>
      <main class="form-area">
        <h3 class="simp-title">パスワードの再設定</h3>
        <form method="POST" action="/password/update">
          {{ csrf_field() }}
          <input type="hidden" name="token" value="{{ $token }}">

          <div class="form-inner">
            <div class="form-item form-group">
              <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus placeholder="メールアドレス">
              @if ($errors->has('email'))
                <span class="help-block" role="alert"><strong>メールアドレスが存在しません。</strong></span>
              @endif
            </div>
          </div>

          <div class="form-inner">
            <div class="form-item form-group">
              <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="パスワード">
              @if ($errors->has('password'))
                <span class="help-block" role="alert">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-inner">
            <div class="form-item form-group">
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="パスワード確認用">
              @if ($errors->has('password'))
                <span class="help-block" role="alert">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
              @endif
            </div>
            <div class="btn-wrap btn-wrap--mt"><button type="submit" class="btn btn--blue btn--form">変更する</button></div>
          </div>

        </form>
      </main>
    </div>
  </div>
@endsection