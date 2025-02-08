<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('welcome');
});


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


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
