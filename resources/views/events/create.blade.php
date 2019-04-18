@extends('layouts.app')

@section('styles')
 <link rel="stylesheet" href="/vendor/css/jquery.datetimepicker.min.css">
 <style>
  .xdsoft_calendar table tr th:nth-child(1){
    background-color: #FFD1D1 !important;
    color: #990000
  }
  .xdsoft_day_of_week0{
    background-color: #FFD1D1 !important;
    color: #000;
  }
  .xdsoft_calendar table tr th:nth-child(7){
    background-color: #CCF9FF !important;
    color: #0000FF;
  }
  .xdsoft_day_of_week6{
    background-color: #CCF9FF !important;
    color: #0000FF;
  }
  .xdsoft_disabled{
    opacity: 0.1 !important;
  }
  .xdsoft_datetimepicker .xdsoft_calendar td, 
  .xdsoft_datetimepicker .xdsoft_calendar th{
    color: #333 !important;
  }
 </style>
@endsection

@section('content')
<div id="eventCreate">
  <form method="POST" action="/event/create/store" autocomplete="off" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" name="cap_none_num" value="{{ rand(1,5) }}">
    <div class="createEventHead">
      <div class="createEventName">
        <input 
          type="text" 
          placeholder="イベント名" 
          value="{{ old('event_name') }}" 
          class="inputTag{{ $errors->has('event_name') ? ' has-error' : '' }}" 
          name="event_name" 
          required
          value="{{ old('event_name') }}"
        >
        @if ($errors->has('event_name'))
          <span class="help-block"><strong>{{ $errors->first('event_name') }}</strong></span>
        @endif
      </div>
      <div class="artistDeleteMode"><img src="/img/gomibako.svg" alt=""></div>
      <div class="createEventSave"><button class="submitButton submitButton--m">作成</button></div>
    </div>
    <div class="createWrap">
      <aside class="createSide">
        <h2 class="createTitle">イベント情報</h2>
        <section class="createInner createInfo">
          <div class="createLine">
            <div class="createSideTitle">日程</div>
            <div class="createSideType">
              <input 
                id="datepicker" 
                type="text" 
                placeholder="2019/05/11" 
                name="open_date" 
                class="inputTag{{ $errors->has('open_date') ? ' has-error' : '' }}" 
                autocomplete="off" 
                required
                value="{{ old('open_date') }}"
              >
              @if ($errors->has('open_date'))
                <span class="help-block"><strong>{{ $errors->first('open_date') }}</strong></span>
              @endif
            </div>
          </div>
          <div class="createLine">
            <div class="createSideTitle">時間 <span class="rei">OPEN：START</span></div>
            <div class="createSideType createSideType--col2">
              <input type="text" placeholder="18:00" name="event_open" class="inputTag{{ $errors->has('event_open') ? ' has-error' : '' }}" data-time value="{{ old('event_open') }}" required>
              @if ($errors->has('event_open'))
                <span class="help-block"><strong>{{ $errors->first('event_open') }}</strong></span>
              @endif
              <input type="text" placeholder="18:30" name="event_start" class="inputTag{{ $errors->has('event_start') ? ' has-error' : '' }}" data-time value="{{ old('event_start') }}" required>
              @if ($errors->has('event_start'))
                <span class="help-block"><strong>{{ $errors->first('event_start') }}</strong></span>
              @endif
            </div>
          </div>
          <div class="createLine">
            <div class="createSideTitle">会場</div>
            <div class="createSideType">
              <input 
                type="text" 
                placeholder="下北沢Reg" 
                name="location_name" 
                value="{{ old('location_name') }}"
                required
                class="inputTag{{ $errors->has('location_name') ? ' has-error' : '' }}" 
              >
              @if ($errors->has('location_name'))
                <span class="help-block"><strong>{{ $errors->first('location_name') }}</strong></span>
              @endif
            </div>
            <div class="createSideType"><input type="text" placeholder="URL" name="location_url" class="inputTag"></div>
          </div>
          <div class="createLine">
            <div class="createSideTitle">チケット代</div>
            <div class="createSideType"><input type="text" placeholder="2000円" name="ticket_price" class="inputTag"></div>
          </div>
          <div class="createLine">
            <div class="createSideTitle">画像</div>
            <div class="createSideType">
              <div class="infoCap up-img-area js-img-append">
                <span class="plus"><b>＋</b></span>
                <input type="file" class="inputCover" name="event_cap" accept="image/*" />
              </div>
            </div>
          </div>
        </section>
      </aside>
      <main class="createMain">
        <h2 class="createTitle">出演者アーティスト</h2>
        <section class="createInner artistList">
          <div class="artistBox">
            <div class="artistTime"><input type="text" name="artist[0][artist_time]" data-name="artist_time" data-time placeholder="18:00"></div>
            <div class="artistCap up-img-area js-img-append">
              <span class="plus"><b>＋</b></span>
              <input type="file" class="inputCover" name="artist[0][artist_cap]" data-name="artist_cap" accept="image/*" />
            </div>
            <div class="artistBoxInner">
              <div class="createLine">
                <div class="createSideType"><input type="text" name="artist[0][artist_name]" data-name="artist_name" placeholder="アーティスト名" class="inputTag" required></div>
              </div>
              <div class="createLine">
                <div class="createSideType"><input type="text" name="artist[0][artist_youtube]" data-name="artist_youtube" placeholder="YouTube" class="inputTag"></div>
              </div>
              <div class="createLine">
                <div class="createSideType"><input type="text" name="artist[0][artist_tw]" data-name="artist_tw" placeholder="twitter" class="inputTag"></div>
              </div>
            </div>
            <div class="artistBoxDelete"><span>×</span></div>
          </div>
          <div class="artistBoxAdd"><span class="plus js-box-puls"><b>＋</b></span></div>
        </section>
      </main>
    </div>
  </form>
</div>
@endsection

@section('scripts')
<script src="/vendor/js/jquery.datetimepicker.full.min.js"></script>
<script>
  $(function() {

    
    var deleteModeFlg = false;
    var artistBoxTotal = 1;
    var artistBoxNumChangeFlg = function(n){
      if(n == -1){
        artistBoxTotal--;
        if(artistBoxTotal < 1) artistBoxTotal = 1;
      }else{
        artistBoxTotal++;
      }
      $('[data-name="artist_name"]').attr('required', 'required');
    }

    var deleteModeChange = function(bool){
      if(bool){
        $('.artistBox').addClass('mode');
        $('.artistDeleteMode').addClass('is-active'); 
      }else{
        $('.artistBox').removeClass('mode');
        $('.artistDeleteMode').removeClass('is-active');
      }
      deleteModeFlg = bool;
    }

    //イベント郡
    $('.artistDeleteMode').on('click',function(){
      deleteModeChange(!deleteModeFlg);
    });

    $('body').on('click','.artistBoxDelete',function(){
      if(deleteModeFlg){
        if($('.artistList .artistBox').length <= 1){
          deleteModeChange(false);
        }else{
          $(this).parents('.artistBox').remove();
        }
      }
      nameSet();
      artistBoxNumChangeFlg(-1);
    });

    $('body').on('click','input',function(){
      deleteModeChange(false);
    });

    var nameSet = function(){
      $('.artistBox').each(function(index, el) {
        for(var i = 0; i < $(this).find('[name]').length; i++){
          var pushName = $(this).find('[name]').eq(i).attr('data-name');
          $(this).find('[name]').eq(i).attr('name', `artist[${index}][${pushName}]`);
        }
      });
    }


    $('body').on({
      mouseenter: function() {
        if($(this).find('img').attr('src')){
          $(this).append('<div class="capDelete">画像を削除</div>');
        }
      },
      mouseleave: function() {
        $('.capDelete').remove();
      }
    }, '.up-img-area');

    $('body').on('click','.capDelete',function(e){
      e.preventDefault();
      $(this).siblings('.inputCover').attr('value', '');
      $(this).siblings('img').remove();
      $('.capDelete').remove();
    });



    

    //日付と時間
    $.datetimepicker.setLocale('ja');
    $( "#datepicker" ).datetimepicker({
      minDate: 0,
      format:'Y/m/d',
      timepicker:false
    });


    var myDatetimePicker = function(){
      $('[data-time]').each(function(index, el) {
        $(this).datetimepicker({
          datepicker:false,
          format:'H:i',
          step:15,
          minTime : '12:00',  //受付開始時間
          maxTime : '23:00',  //終了時間,
        });
      });  
    }
    myDatetimePicker();
    

    //選択したファイルを表示する
    $('body').on('change', '[type="file"]', function(){
      var fr = new FileReader();
      var $appendTarget = $(this).parents('.js-img-append');
      $(this).siblings('img').remove();
      fr.onload = function() {
        let img = $('<img>').attr('src', fr.result);
        $appendTarget.append(img);
      };
      fr.readAsDataURL(this.files[0]);
    });

    $('.js-box-puls').on('click',function(){
      var artistBoxTemplate = `
        <div class="artistBox">
          <div class="artistTime"><input type="text" name="" data-name="artist_time" placeholder="18:00" data-time></div>
          <div class="artistCap up-img-area js-img-append">
            <span class="plus"><b>＋</b></span>
            <input type="file" class="inputCover" name="" data-name="artist_cap" accept="image/*" />
          </div>
          <div class="artistBoxInner">
            <div class="createLine">
              <div class="createSideType"><input type="text" name="" data-name="artist_name" placeholder="アーティスト名" class="inputTag" required></div>
            </div>
            <div class="createLine">
              <div class="createSideType"><input type="text" name="" data-name="artist_youtube" placeholder="YouTube" class="inputTag"></div>
            </div>
            <div class="createLine">
              <div class="createSideType"><input type="text" name="" data-name="artist_tw" placeholder="twitter" class="inputTag"></div>
            </div>
          </div>
          <div class="artistBoxDelete"><span>×</span></div>
        </div>
      `;
      $('.artistList').append(artistBoxTemplate);
      $('.artistList').append($('.artistBoxAdd'));
      deleteModeChange(false);
      nameSet();
      artistBoxNumChangeFlg(1);

      myDatetimePicker();
      
    });



  });
  
</script>
@endsection