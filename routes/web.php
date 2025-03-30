<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Auth\LoginForm;
use App\Livewire\Auth\RegisterForm;

Route::get('/', function () {
    return Auth::check() ? redirect()->route('dashboard') : redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', LoginForm::class)->name('login');
    Route::get('/register', RegisterForm::class)->name('register');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard'); // Vista del dashboard
    })->name('dashboard');

    Route::post('/logout', function () {
        Auth::logout();
        return redirect()->route('login');
    })->name('logout');
});

