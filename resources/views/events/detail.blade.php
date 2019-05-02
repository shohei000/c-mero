@extends('layouts.app')

@section('ogp')
	<meta property="og:title" content="{{$event->event_name}}" />
	<meta property="og:description" content="{{$event->open_date}}" />
	<meta property="og:site_name" content="https://c-mero.site" />
	<meta name="twitter:card" content="summary_large_image" />
	<meta property="og:image" content="https://c-mero.site/storage/event/{{ $event->id }}/{{$event->event_cap}}" />
@endsection

@section('content')
	<div id="eventView">
		<div class="mainMove">
	  	<iframe id="popup-YouTube-player" width="100%" height="100%" src="https://www.youtube.com/embed/amBB_0XMOs0?enablejsapi=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"></iframe>
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
		<div class="eventInfo">
			<div class="eventInfo__date"><span class="dataIcon"><img src="/img/calendar.svg" alt=""></span>{{$event->open_date}}</div>
			<div class="eventInfo__location">
				<span class="locationIcon"><img src="/img/maps-and-flags.svg" alt=""></span>
				@if($event->location_url)
					<a href="{{$event->location_url}}">{{$event->location_name}}</a>
				@else
					<a href="https://www.google.com/search?q={{$event->location_name}}">{{$event->location_name}}</a>
				@endif
			</div>
			<div class="eventInfo__so">
				<span class="soIcon"><img src="/img/start-flag.svg" alt=""></span>
				<span class="soText">OPEN / {{ $event->event_open }}</span><span class="soText">START / {{ $event->event_start }}</span>
			</div>
			<div class="eventInfo__eventTitle">{{$event->event_name}}</div>
			<div class="eventInfo__supplement">{!! nl2br(e($event->supplement)) !!}</div>
		</div>
		<h3 class="simp-title">出演アーティスト</h3>
		<ul class="artistList <?php if(count($artists) <= 3) echo 'artis3'; ?>">
			<?php $i=0; ?>
			@foreach($artists as $artist)
			<li>
				<div href="#" class="artistElm" data-youTube="{{ $artist->artist_youtube }}" data-artist-id="<?php echo $i++; ?>">
					@if($artist->artist_youtube)<span class="YouTubeTrigger"><img src="/img/play-button-silhouette.svg" alt=""></span>@endif
					<div class="artistCap">
						@if($artist->artist_cap)
							<img src="/storage/artists/{{ $artist->id }}/{{$artist->artist_cap}}">
						@else
							<img src="/img/event/soon.png">
						@endif
					</div>
					<div class="artistInfo">
						<h2 class="artistName">
							@if($artist->artist_tw)
								<a href="{{ $artist->artist_tw }}">{{ $artist->artist_name }} <img src="/img/icon_twitter_blue.svg" alt=""></a>
							@else
								{{ $artist->artist_name }}
							@endif
						</h2>
						<ul class="artisLabels">
							<li class="time">@if($artist->artist_time) <img src="/img/clock.png" alt=""> {{ $artist->artist_time }}〜 @endif</li>
						</ul>
					</div>
				</div>
			</li>
			@endforeach
		</ul>
		<div class="zoomCap"><img src="" alt=""></div>
		<div class="twitterShare">
			<a href="//twitter.com/share?url={{ Request::url()}}" class="twitter-share-button">
				このイベントを盛り上げる！
				<span><img src="/img/icon_twitter_white.svg" alt=""></span>
			</a>
		</div>
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
					setTimeout(function() {
					  playerWindowDOM.css('opacity',1);
					}, 500);
				}
				if(state == 'cap'){
					$('.pageKey').show();
					$('.mainMove').hide();
					playerWindowDOM.css('opacity',0);
				}
			}
			
			$('.artistElm').each(function(index, el) {
				var youTubeUrl = $(this).attr('data-youTube');
				youTubeId = youTubeUrl.replace('https://www.youtube.com/watch?v=', '');
				youTubeUrlArray.push(youTubeId);
			});

			$('.YouTubeTrigger').on('click',function(e){
				var YouTubeN = $(this).parents('.artistElm').attr('data-artist-id');
				playerWindowDOM.attr('src', 'https://www.youtube.com/embed/'+ youTubeUrlArray[YouTubeN] + '?enablejsapi=1&playsinline=1&showinfo=0');
				setTimeout(() => {
				  playerWindow.postMessage('{"event":"command","func":"'+'playVideo'+'","args":""}', '*');
				},500)
				stateChange('YouTube');
				$('body,html').animate({scrollTop:0}, 500, 'swing');
			});

			$('.artistCap').on("touchstart", function(){
				var imgSrc = $(this).find('img').attr('src');
				$('.zoomCap').show().append('<img src="'+imgSrc+'">');
			});
			$('.artistCap').on("touchend", function(){
				$('.zoomCap').hide().find('img').remove();
			});

			$('.eventInfo').on('click',function(){
				playerWindow.postMessage('{"event":"command","func":"'+"pauseVideo"+'","args":""}', '*');
			  stateChange('cap');
			});

		});
	</script>
@endsection