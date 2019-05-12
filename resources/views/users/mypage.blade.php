@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
@endsection

@section('content')
  <div class="contents contents--default">
    @if(!empty($events[0]))
      <h1 class="main-title">あなが作成したイベント</h1>
    @else
      <h1 class="main-title">イベントを作成しよう！</h1>
    @endif
    <div class="myEvent">
      @if(!empty($events[0]))
        <ul class="sortTab">
          <li><a href="/user/mypage?sort_type=open_date" class="{{ $sort_type === 'open_date' ? 'active' : ''}}">開催日順</a></li>
          <li><a href="/user/mypage?sort_type=updated_at" class="{{ $sort_type === 'updated_at' ? 'active' : ''}}">作成・変更した順</a></li>
        </ul>
        <ul class="eventList">
          @foreach($events as $event)
            <li class="eventListLi">
              <span class="labelDate"><b>{{ $event->open_date }}</b></span>
              <div class="statusArea @if($event->status == 0)notOpen @endif">
                <form action="/event/{{ $event->id }}/status" id="form_status_{{ $event->id }}" method="post">
                  {{ csrf_field() }}
                    <select name="status" data-id="{{ $event->id }}" onchange="statusChange(this);" class="selectInput">
                      <option value="1" @if($event->status == 1) selected @endif>公開</option>
                      <option value="0" @if($event->status == 0) selected @endif>非公開</option>
                    </select>
                </form>
              </div>
              <form action="/event/{{ $event->id }}/destroy" id="form_{{ $event->id }}" method="post">
                {{ csrf_field() }}
                <a href="#" data-id="{{ $event->id }}" onclick="deletePost(this);" class="eventDelete">削除</a>
              </form>
              <a href="/event/{{$event->id}}">
                <div class="eventListCap">
                  <div class="artistsTotal">
                    <span>出演者数：{{count($event->event_artists)}}</span>
                  </div>
                  <ul class="artistsTotalList">
                    @foreach($event->event_artists as $event_artist)
                      <li>{{ $event_artist->artist_name }}</li>
                    @endforeach
                  </ul>
                  @if($event->event_cap)
                    <img src="/storage/event/{{ $event->id }}/{{ $event->event_cap }}" alt="">
                  @else
                    <span class="eventListCapNote">画像は未設定です</span>
                  @endif
                </div>
                <h2 class="eventListTitle">{{ $event->event_name }}</h2>
              </a>
              <div class="btn-wrap"><a href="/event/{{$event->id}}/edit/" class="btn btn--edit">イベントを編集</a></div>
            </li>
          @endforeach
        </ul>
        {{ $events->links('vendor.pagination.bootstrap-4') }}
        <div class="btn-wrap"><a href="/event/create" class="btn btn--blue btn--createEvent">イベントを作成する</a></div>
      @else
      <div class="rocket"><a href="/event/create"><img src="/img/event/project.svg" alt=""></a></div>
      <div class="btn-wrap"><a href="/event/create" class="btn btn--blue btn--createEvent">イベントを作成する</a></div>
      @endif
    </div>

      <!-- <div class="btn-wrap"><a href="/user/edit" class="btn btn--blue btn--form">プロフィール編集</a></div> -->

  </div>


@endsection

@section('scripts')
<script>
function deletePost(e) {
  'use strict';
  if (confirm('本当に削除していいですか?')) {
    document.getElementById('form_' + e.dataset.id).submit();
  }
}
function statusChange(e) {
  document.getElementById('form_status_' + e.dataset.id).submit();
}
</script>
@endsection


