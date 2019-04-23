@extends('layouts.app')

@section('content')
  <div class="contents contents--default">
    <div class="form-wrap">
      <h2 class="form-ttl"><img src="/img/logo_text.svg" alt=""></h2>
      <main class="form-area">
        <h3 class="simp-title">メールアドレスを入力してください</h3>
        <form method="POST" action="{{ route('password.email') }}">
          {{ csrf_field() }}
          <div class="form-inner">
            <div class="form-item form-group">
              <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="メールアドレス" required>
              @if ($errors->has('email'))
                <span class="help-block" role="alert"><strong>メールアドレスが存在しません。</strong></span>
              @endif
            </div>
            <div class="btn-wrap btn-wrap--mt"><button type="submit" class="btn btn--blue btn--form">送信する</button></div>
          </div>
        </form>
      </main>
    </div>
  </div>
@endsection

