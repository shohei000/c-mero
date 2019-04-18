@extends('layouts.app')

@section('content')
  <div class="contents">
    <div class="form-wrap">
      <h2 class="form-ttl">イベントの作成</h2>
      <main class="form-area">
        <form action="/event/create/store" method="post" name="event_confirm">
          {{ csrf_field() }}
          <div class="form-inner">
            <div class="form-item">
              {{ $data['open_date'] }}
              {{Form::hidden('open_date', $data['open_date'])}}
            </div>
            <div class="form-item">
              {{ $data['location'] }}
              {{Form::hidden('location', $data['location'])}}
            </div>
            <div class="form-item">
              {{ $data['title'] }}
              {{Form::hidden('title', $data['title'])}}
            </div>
          </div>
            <div class="form-inner">
            <div class="form-item">
              {{ $data['start_end'] }}
              {{Form::hidden('start_end', $data['start_end'])}}
            </div>
            <div class="form-item">
              {{ $data['map'] }}
              {{Form::hidden('map', $data['map'])}}
            </div>
            <!-- <div class="form-item"><input type="file" placeholder=""></div> -->
          </div>
          <div class="btn-wrap"><a href="javascript:document.event_confirm.submit()" class="btn btn--l">イベントを作成する</a></div>
        </form>
      </main>
    </div>
  </div>
@endsection
