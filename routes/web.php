<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::group(['middleware' => 'guest'], function (){
	Route::get('/', 'HomeController@index')->name('mypage'); 

	Route::get('user/login', 'Auth\LoginController@showLoginForm')->name('login');
	Route::post('user/login', 'Auth\LoginController@login');

  // twitterログインURL
  Route::get('auth/twitter', 'Auth\LoginController@redirectToProvider');
  // twitterコールバックURL
  Route::get('auth/twitter/callback', 'Auth\LoginController@handleProviderCallback');

  //ユーザー登録
  Route::get('user/sign_up', 'UserController@sign_up')->name('sign_up');
  Route::post('user/sign_up/store', 'UserController@store');
  Route::get('user/sign_up/complete', 'UserController@complete');

  //パスワードの再設定
  Route::get('pass', 'Auth\ForgotPasswordController@showLinkRequestForm');
  Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name("password.email");
  Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
  Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
  Route::post('password/reset', 'Auth\ResetPasswordController@reset');

});


Route::group(['middleware' => 'auth'], function(){
	Route::get('user/mypage/', 'UserController@mypage')->name('mypage');
	Route::get('user/logout', 'Auth\LoginController@logout')->name('logout');
	Route::get('user/edit', 'UserController@edit')->name('edit');
	Route::post('user/edit/update', 'UserController@update');

  //イベント
  Route::get('event/create', 'EventController@create')->name('event.create');
  Route::post('event/create/confirm', 'EventController@confirm');
  Route::post('event/create/store', 'EventController@store');
  Route::get('event/{id}/edit/', 'EventController@edit');
  Route::post('event/{id}/update/', 'EventController@update');
  Route::post('event/{id}/destroy/', 'EventController@destroy');
});

Route::get('event/{id}', 'EventController@detail');

