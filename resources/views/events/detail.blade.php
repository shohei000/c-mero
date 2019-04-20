@extends('layouts.app')

@section('content')
	<div id="eventView">
		<div class="mainMove">
	  	<iframe id="popup-YouTube-player" width="100%" height="100%"" src="https://www.youtube.com/embed/amBB_0XMOs0?enablejsapi=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"></iframe>
	  </div>
	  <div class="pageKey pageKey--event">
	  	@if($event->event_cap)
				<img src="/storage/event/{{ $event->id }}/{{$event->event_cap}}" alt="">
			@else
				<div class="eventCapNone eventCapNone--{{$event->cap_none_num}}">
					<div class="eventCapNoneInner">
						<h2 class="eventCapNoneTitle">{{$event->event_name}}</h2>
					</div>
				</div>
			@endif
		</div>
		<ul class="eventInfo">
			<li class="eventInfo__date">{{$event->open_date}}</li>
			<li class="eventInfo__location"><a href="https://www.google.com/search?q={{$event->location_name}}">{{$event->location_name}}</a></li>
			<li class="eventInfo__eventTitle">{{$event->event_name}}</li>
		</ul>
		<h3 class="simp-title">出演アーティスト</h3>
		<ul class="artistList">
			<?php $i=0; ?>
			@foreach($artists as $artist)
			<li>
				{{$artist->artist_youTube}}
				<div href="#" class="artistElm" data-youTube="{{ $artist->artist_youtube }}" data-artist-id="<?php echo $i++; ?>">
					<span class="YouTubeTrigger">YouTubeを聞く</span>
					<div class="artistInfo">
						<h2 class="artistName">{{ $artist->artist_name }}</h2>
						<ul class="artisLabels">
							<li>@if($artist->artist_time) {{ $artist->artist_time }}〜 @endif</li>
						</ul>
					</div>
					<div class="artistCap">
						@if($artist->artist_cap)
							<img src="/storage/artists/{{ $artist->id }}/{{$artist->artist_cap}}">
						@else
							<img src="/img/logo_frame.svg">
						@endif
					</div>
				</div>
			</li>
			@endforeach
		</ul>
	</div>
@endsection

@section('scripts')
	<script>
		$(function(){
			var state = 'cap';
			var youTubeUrlArray = [];
			var playerWindowDOM = $('#popup-YouTube-player');
			var playerWindow = $('#popup-YouTube-player')[0].contentWindow;
			function stateChange(state){
				if(state == 'YouTube'){
					$('.pageKey').hide();
					$('.mainMove').show();
				}
				if(state == 'cap'){
					$('.pageKey').show();
					$('.mainMove').hide();
				}
			}
			$('.artistElm').each(function(index, el) {
				var youTubeUrl = $(this).attr('data-youTube');
				youTubeId = youTubeUrl.replace('https://www.youtube.com/watch?v=', '');
				youTubeUrlArray.push(youTubeId);
			});
			$('.YouTubeTrigger').on('click',function(e){
				var YouTubeN = $(this).parents('.artistElm').attr('data-artist-id');
				playerWindowDOM.attr('src', 'https://www.youtube.com/embed/'+ youTubeUrlArray[YouTubeN] + '?enablejsapi=1');
				setTimeout(() => {
				  playerWindow.postMessage('{"event":"command","func":"'+'playVideo'+'","args":""}', '*');
				},500)
				stateChange('YouTube');
				$('body,html').animate({scrollTop:0}, 500, 'swing');
			});
		});
	</script>
@endsection