@extends('layouts.app')

@section('content')
	<div id="eventView">
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
			@foreach($artists as $artist)
			<li>
				<a href="detail.html" class="artistElm">
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
				</a>
			</li>
			@endforeach
		</ul>
	</div>
@endsection
