<?php

namespace App\Http\Controllers;

use Validator;
use App\User;
use App\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class UserController extends Controller
{

  public $messages = [
    'email.required' => 'メールアドレスは必須です。',
    'email.email' => 'メールアドレスの形式が間違っています。',
    'email.max' => 'メールアドレスは191文字以内で入力してください。',
    'email.unique' => 'このメールアドレスは既に存在しています。',
    'password.required' => 'パスワードは必須です。',
    'password.min' => 'パスワードは8文字以上で入力してください。',
    'password.max' => 'パスワードは191文字以内で入力してください。',
    'password.confirmed' => 'パスワード(確認)と一致しません。',
    'name.max' => 'ニックネーム（名前）は191文字以内で入力してください。',
  ];

  public $rules = [
    'email' => 'required|email|unique:users|max:191',
    'password' => 'required|min:8|max:191|confirmed',
    'name' => 'max:191',
  ];

  public function sign_up(){
    $user = new User;
    return view('users.sign_up')->with(compact("user"));
  }

  public function store(Request $request){
    $user = new User;
    $data = $request->all();
    $validation = Validator::make($data, $this->rules, $this->messages);
    if($validation->fails()) {
      return redirect()->back()->withErrors($validation->errors())->withInput();
    }
    $user->fill($data)->save();
    \Auth::login($user);
    return redirect()->action('UserController@mypage');
  }

  public function mypage(Request $request){
    $user = \Auth::user();
    $sort_array = ['updated_at', 'desc'];
    if($request->get('sort_type')){
      $sort_array = $this->sortArrayGet($request->get('sort_type'));
    }
    $events = $user->events()->orderBy($sort_array[0], $sort_array[1])->paginate(15);
    setlocale(LC_ALL, 'ja_JP.UTF-8');
    foreach ($events as $event) {
      $event->open_date = Carbon::parse($event->open_date)->formatLocalized('%m月%d日(%a)');
      $event['event_artists'] = $event->artists()->get();
    }
    return view('users.mypage', [
      'events' => $events,
      'user' => $user,
      'sort_type' => $sort_array[0]
    ]);
  }

  public function edit(){
    $user = \Auth::user();
    return view('users.edit');
  }

  public function update(Request $request){
    $data = $request->all();
    $user = \Auth::user();
    $this->rules['password'] = '';
    if($data['email'] == $user->email){
      $this->rules['email'] = '';
    }
    $validation = Validator::make($data, $this->rules, $this->messages);
    if($validation->fails()) {
      return redirect()->back()->withErrors($validation->errors())->withInput();
    }
    $user->fill($data)->save();
    return redirect('/user/mypage');
  }

  private function sortArrayGet($sortType){
    $sort_array = [];
    if($sortType == 'open_date')  $sort_array = ['open_date', 'asc'];
    if($sortType == 'updated_at')  $sort_array = ['updated_at', 'desc'];
    return $sort_array;
  }


}
