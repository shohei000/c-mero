<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Event;
use App\Artist;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{



	public $messages = [
    'event_name.required' => 'イベント名は必須です。',
    'open_date.required' => '日程は必須です。',
    'location_name.required' => '会場は必須です。',
    'event_open.required' => 'OPEN時間は必須です。',
    'event_start.required' => 'START時間は必須です。',
    'event_cap.max' => 'ファイルのサイズが大きすぎます',
    'artist.*.artist_cap' => 'ファイルのサイズが大きすぎます',
  ];

  public $rules = [
    'event_name' => 'required|max:191',
    'open_date' => 'required',
    'location_name' => 'required|max:191',
    'event_open' => 'required',
    'event_start' => 'required',
    'event_cap' => 'image|max:3000',
    'artist.*.artist_cap' => 'image|max:3000',
  ];

	public function detail(Request $request){
		$event = Event::where('id', $request->id)->first();
		$artists = $event->artists()->orderby('artist_time','asc')->get();
		setlocale(LC_ALL, 'ja_JP.UTF-8');
		$event['open_date'] = Carbon::parse($event->open_date)->formatLocalized('%Y年%m月%d日(%a)');;
		return view('events.detail')->with(compact(["event","artists"]));
	}

	public function create(){
		$user = new User;
		$event = new Event;
		return view('events.create')->with(compact(["user",'event']));
	}

	public function confirm(Request $request){
		$data = $request->all();
		return view('events.confirm')->with(compact("data"));
	}

	public function store(Request $request){
		$data = $request->all();
		$event = new Event;
		$event = $event->fill($data);

		$validation = Validator::make($data, $this->rules, $this->messages);
    if($validation->fails()) {
      return redirect()->back()->withErrors($validation->errors())->withInput();
    }


		\Auth::user()->events()->save($event);
		if(isset($data['event_cap'])){
			$path = '/public/event/' . $event->id;
			$event['event_cap'] = $this->fileTypeGet($data['event_cap'], $path);
			\Auth::user()->events()->save($event);
		}

  	foreach ($data['artist'] as $artist_single) {
  		$artist = new Artist;
  		foreach ($artist_single as $k => $v) {
  			$artist[$k] = $v;
  		}
  		$artist->event()->associate($event);
  		$artist->save();
  		if(isset($artist_single['artist_cap'])){
				$path = '/public/artists/' . $artist->id;
				$artist['artist_cap'] = $this->fileTypeGet($artist_single['artist_cap'], $path);
			}
			$artist->save();
  	}
	
		return redirect('/user/mypage');
	}

	public function edit(Request $request, $id){
		$event = Event::where('id', $id)->first();
		if(\Auth::user()->id !== $event->user_id){
			return redirect('/user/login/');
		}
		$artists = $event->artists()->orderby('artist_time','asc')->get();
		return view('events.edit')->with(compact("artists", "event"));
	}

	public function update(Request $request, $id){
		$data = $request->all();
		$event = Event::where('id', $id)->first();
		$event = $event->fill($data);
		if($data['cap_delete_flg'] == 1){
			$event['event_cap'] = null;
		}

		$validation = Validator::make($data, $this->rules, $this->messages);
    if($validation->fails()) {
      return redirect()->back()->withErrors($validation->errors())->withInput();
    }

		\Auth::user()->events()->save($event);
			if(isset($data['event_cap'])){
			$path = '/public/event/' . $event->id;
			$event['event_cap'] = $this->fileTypeGet($artist_single['artist_cap'], $path);
		}
		\Auth::user()->events()->save($event);

		foreach ($data['artist'] as $artist_single) {
			if(isset($artist_single['id'])){
				$artist = Artist::where('id', $artist_single['id'])->first();
				if($artist_single['delete_flg'] == 1){
					$artist->delete();
				}
				if($artist_single['cap_delete_flg'] == 1){
					$artist->artist_cap = null;
				}
			}else{
				$artist = new Artist;
			}
			foreach ($artist_single as $k => $v) {
  			$artist[$k] = $v;
			}
			$artist->event()->associate($event);
  		$artist->save();
  		if(isset($artist_single['artist_cap'])){
				$path = '/public/artists/' . $artist->id;
				$artist['artist_cap'] = $this->fileTypeGet($data['artist_cap'], $path);
			}
			$artist->save();
  	}

		return redirect('/event/' . $id .'/edit/');
	}

	public function destroy($id){
		$event = Event::find($id);
		$event->delete();
		return redirect('/user/mypage/');
	}

	private function fileTypeGet($file, $path){
		$uniqid = uniqid();
		$ext = $file->getClientOriginalExtension();
		$fileName = $uniqid . '.' . $ext;
    Storage::putFileAs($path , $file, $fileName);
    return $uniqid . '.' . $ext;
	}

}
