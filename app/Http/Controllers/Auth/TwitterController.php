<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Socialite;
use Illuminate\Support\Facades\Auth;

class TwitterController extends Controller
{

    // ログイン
    public function redirectToProvider(){
        return Socialite::driver('twitter')->redirect();
    }

    // コールバック
    public function handleProviderCallback(){
        try {
            $twitterUser = Socialite::driver('twitter')->user();
        } catch (Exception $e) {
            return redirect('auth/twitter');
        }
        // 各自ログイン処理
        // 例
        $user = User::where('twitter_id', $twitterUser->id)->first();
        if (!$user) {
            $user = User::create([
                'twitter_id' => $twitterUser->id,
                'name' => $twitterUser->name,
          ]);
        }
        Auth::login($user);
        return redirect('/');
    }

}

