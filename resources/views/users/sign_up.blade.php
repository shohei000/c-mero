@extends('layouts.app')

@section('content')
  <div class="contents contents--default">
    <div class="form-wrap">
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
@endsection
