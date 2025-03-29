<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Auth\LoginForm;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', LoginForm::class)->name('login');
