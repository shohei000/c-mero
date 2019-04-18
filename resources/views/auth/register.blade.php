@extends('layouts.app')

@section('content')
  <div class="contents">
    <div class="form-wrap">
      <h2 class="form-ttl">新規登録</h2>
      <main class="form-area">
        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
          {{ csrf_field() }}
          <div class="form-inner">

            <div class="form-item form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus placeholder="アカウント名">
              @if ($errors->has('name'))
                <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
              @endif
            </div>

            <div class="form-item form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Eメール">
              @if ($errors->has('email'))
                <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
              @endif
            </div>

            <div class="form-item form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <input id="password" type="password" class="form-control" name="password" required placeholder="パスワード">
              @if ($errors->has('password'))
                <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
              @endif
            </div>

            <div class="form-item form-group">
              <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="確認用パスワード">
              </div>
            </div>

          </div>
          <div class="btn-wrap"><button type="submit" class="btn btn--blue btn--l">新規登録する</button></div>
        </form>

      </main>
    </div>
  </div>
@endsection
