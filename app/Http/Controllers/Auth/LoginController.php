<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    protected function _registerOrLoginUser($data)
    {
        $user = User::query()->firstWhere('email', $data->email);

        if (!$user) {
            $user = new User();

            $user->name = $data->name;
            $user->email = $data->email;
            $user->provider_id = $data->id;
            $user->avatar = $data->avatar;
            $user->password = Hash::make('123456');

            $user->save();
        }

        Auth::login($user);
    }

    //Google Login
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    //Google callback
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();

        $this->_registerorLoginUser($user);
        return redirect()->route('dashboard');
    }


    //Facebook Login
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->stateless()->redirect();
    }

    //facebook callback
    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->stateless()->user();

        $this->_registerorLoginUser($user);
        return redirect()->route('dashboard');
    }


    //Github Login
    public function redirectToGithub()
    {
        return Socialite::driver('github')->stateless()->redirect();
    }

    //github callback
    public function handleGithubCallback()
    {
        $user = Socialite::driver('github')->stateless()->user();

        $this->_registerorLoginUser($user);
        return redirect()->route('dashboard');
    }
}
