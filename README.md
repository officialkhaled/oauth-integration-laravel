<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## OAuth Integration in Laravel with Socialite

## Current Integrations
- <img src="https://img.icons8.com/color/48/000000/google.png" alt="Google" width="20" height="20"/> Google
- <img src="https://img.icons8.com/color/48/000000/facebook.png" alt="Facebook" width="20" height="20"/> Facebook
- <img src="https://img.icons8.com/color/48/000000/github.png" alt="GitHub" width="20" height="20"/> GitHub

## Installation

1. Create a Laravel Project
```bash
composer create-project "laravel/laravel:^10.0" example-app
```
2. Install Breeze Starter Kit
```bash
composer require laravel/breeze --dev
php artisan breeze:install

npm install
```

3. Install Socialite Package
```bash
composer require laravel/socialite
```

4. Update the users table migration
```bash
Schema::create('users', function (Blueprint $table) {
    $table->id();

    $table->string('name');
    $table->string('email')->unique();
    $table->timestamp('email_verified_at')->nullable();
    $table->string('avatar')->nullable();
    $table->string('provider_id')->nullable();
    $table->string('password')->nullable();

    $table->rememberToken();
    $table->timestamps();
});
```

5. Update the User model
```bash
protected $fillable = [
    'name',
    'email',
    'avatar',
    'provider_id',
    'password',
];
```
6. Create LoginController and place it inside app/Http/Controllers/Auth
```bash
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

```
7. Add the following lines in the <b>config/services.php</b> and update accordingly
```bash
'google' => [
    'client_id' => env('GOOGLE_CLIENT_ID'),
    'client_secret' => env('GOOGLE_CLIENT_SECRET'),
    'redirect' => 'http://127.0.0.1:8000/login/google/callback', //update
],
'facebook' => [
    'client_id' => env('FACEBOOK_CLIENT_ID'),
    'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
    'redirect' => 'http://127.0.0.1:8000/login/facebook/callback', //update
],
'github' => [
    'client_id' => env('GITHUB_CLIENT_ID'),
    'client_secret' => env('GITHUB_CLIENT_SECRET'),
    'redirect' => 'http://127.0.0.1:8000/login/github/callback', //update
],
```
8. Add the following lines in the <b>.env</b> and update accordingly
```bash
GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=

FACEBOOK_CLIENT_ID=
FACEBOOK_CLIENT_SECRET=

GITHUB_CLIENT_ID=
GITHUB_CLIENT_SECRET=
```
9. Add the following routes
```bash
Route::group(['prefix' => '/login', 'as' => 'login.'], function () {
    //Google
    Route::get('google', [LoginController::class, 'redirectToGoogle'])->name('google');
    Route::get('google/callback', [LoginController::class, 'handleGoogleCallback']);
    
    //Facebook
    Route::get('facebook', [LoginController::class, 'redirectToFacebook'])->name('facebook');
    Route::get('facebook/callback', [LoginController::class, 'handleFacebookCallback']);
    
    //Github
    Route::get('github', [LoginController::class, 'redirectToGithub'])->name('github');
    Route::get('github/callback', [LoginController::class, 'handleGithubCallback']);
});
```
10. Add the following code to your login.blade.php (<i>Icons are optional</i>)
```bash
<div class="mt-1 mb-3 flex justify-evenly gap-12">
    <a href="{{route('login.google')}}"
       class="py-2 btn btn-sm bg-green-500 text-white hover:bg-green-700 w-100">
        <i class="fa-brands fa-google"></i>
    </a>
    <a href="{{route('login.facebook')}}"
       class="py-2 btn btn-sm bg-blue-500 text-white hover:bg-blue-700 w-100">
        <i class="fa-brands fa-facebook"></i>
    </a>
    <a href="{{route('login.github')}}"
       class="py-2 btn btn-sm bg-gray-700 text-white hover:bg-gray-900 w-100">
        <i class="fa-brands fa-github"></i>
    </a>
</div>
```

## Note (<i>You must have the following for the integration to be successful<i/>) [You will find the Client ID and Client Secret here]
- Google Auth Platform Account
- Facebook Meta Developers Account
- GitHub Developer Settings Configured
