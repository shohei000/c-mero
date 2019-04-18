@extends('layouts.app')

@section('content')
  <div class="contents">
    <div class="form-wrap">
      <h2 class="form-ttl">イベントの作成</h2>
      <main class="form-area">
        <form action="/event/create/confirm" method="post" name="event_create">
          {{ csrf_field() }}

          


          <div class="form-inner">
            <div class="form-item">
              {!!Form::text('open_date', $user->open_date, ['placeholder' => '【日付】例）2018年10月5日(水)', 'autocomplete' => 'off', 'v-model' => 'open_date'])!!}
            </div>
            <div class="form-item">
              {!!Form::text('location', $user->location, ['placeholder' => '【場所】例）渋谷O-EAST', 'autocomplete' => 'off'])!!}
            </div>
            <div class="form-item">
              {!!Form::text('title', $user->title, ['placeholder' => '【イベント名】例） 最高の1日にしよう！vol.1', 'autocomplete' => 'off'])!!}
            </div>
          </div>
            <div class="form-inner">
            <div class="form-item">
              {!!Form::text('start_end', $user->start_end, ['placeholder' => '【オープン】例） open 18:00 start 18:30', 'autocomplete' => 'off'])!!}
            </div>
            <div class="form-item">
              {!!Form::text('map', $user->map, ['placeholder' => '【会場のURL】googlemapのURLなど', 'autocomplete' => 'off'])!!}
            </div>
            <!-- <div class="form-item"><input type="file" placeholder=""></div> -->
          </div>
          <div class="btn-wrap">
            <!-- <a href="javascript:document.event_create.submit()" class=""></a> -->
            <button class="btn btn--l" @click="onSubmit()" >確認画面へ</button>
          </div>
        </form>
      </main>
    </div>
  </div>
@endsection


@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script> 
<script>
  new Vue({
    el: '#app',
    data: {
      open_date: 'wwwww',
    },
    methods: {
      onSubmit: function() {
        this.errors = {};
        var self = this;
        var params = {
          open_date: this.open_date,
        };
        axios.post('/event/create/confirm', params)
          .then(function(){
            self.emailSent = true;
          })
          .then(function(){
            self.emailSent = true;
          })
      }
    }
  });
</script>
@endsection