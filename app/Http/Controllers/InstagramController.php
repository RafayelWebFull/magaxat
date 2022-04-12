<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class InstagramController extends Controller
{
    const DRIVER_TYPE = 'instagram';

    public function InstagramLogin()
    {
        return Socialite::driver(static::DRIVER_TYPE)->setScopes(['user_profile'])->redirect();
    }

    public function callback()
    {
        $facebookUser = Socialite::driver(static::DRIVER_TYPE)->user();
        $user = User::firstOrCreate([
            'email' => $facebookUser->email
        ],
        [
            'name' => $facebookUser->name,
            'email' => $facebookUser->email,
            'password' => Hash::make(Str::random(24))
        ]
        );

        Auth::login($user);
        return redirect()->route('home');
    }
}
