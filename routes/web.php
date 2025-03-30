<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Auth\LoginForm;
use App\Livewire\Auth\RegisterForm;

Route::get('/', function () {
    return Auth::check() ? redirect()->route('dashboard') : redirect()->route('login');
});

Route::get('/login', LoginForm::class)->name('login');
Route::get('/register', RegisterForm::class)->name('register');
Route::get('/dashboard', function () {
    return view('dashboard'); // Vista temporal para el dashboard
})->name('dashboard')->middleware('auth');

