@extends('layouts.app')

@section('content')
  <div class="contents">

    <div class="form-wrap">
      <h2 class="form-ttl">プロフィール編集</h2>
      <main class="form-area">
        <form class="form-horizontal" method="POST" action="/user/edit/update" autocomplete="off">
          {{ csrf_field() }}
          @if ($errors->any())
            <div class="alert alert-danger" role="alert">
              @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
              @endforeach
            </div>
          @endif
          <div class="form-inner">
            <div class="form-item form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              {!!Form::text('name', Auth::user()->name, ['autocomplete' => 'off', 'placeholder'=> "アカウント名"])!!}
            </div>

            <div class="form-item form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              {!!Form::text('email', Auth::user()->email, ['autocomplete' => 'off', 'placeholder'=> "メールアドレス"])!!}
            </div>

          </div>
          <div class="btn-wrap"><button type="submit" class="btn btn--blue btn--l">編集する</button></div>
        </form>
      </main>
    </div>
  
  </div><!--contents-->


@endsection
