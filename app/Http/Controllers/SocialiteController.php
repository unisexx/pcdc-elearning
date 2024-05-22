<?php

namespace App\Http\Controllers;

use App\Models\LoginHistory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $userSocial = Socialite::driver($provider)->user();
        // dump($userSocial->name);
        // dump($userSocial->email);
        // dump($userSocial->avatar);
        // dump($userSocial->id);
        // dump($userSocial->token);
        // dump($userSocial->refreshToken);
        // dd($userSocial);

        $user = User::updateOrCreate([
            'provider_id' => $userSocial->id,
            'provider'    => $provider,
        ], [
            'name'          => $userSocial->name,
            'email'         => $userSocial->email,
            'token'         => $userSocial->token,
            'refresh_token' => $userSocial->refreshToken,
        ]);

        Auth::login($user);

        return redirect('/');
    }
}
