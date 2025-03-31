<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
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

    // Rutas de Empresas
    Route::get('/empresas', \App\Livewire\EmpresaView::class)->name('empresas.view');
    Route::get('/empresas/create', \App\Livewire\EmpresaCreate::class)->name('empresas.create');
    Route::get('/empresas/edit/{id}', \App\Livewire\EmpresaEdit::class)->name('empresas.edit');

    // Rutas de Cuentas
    Route::get('/cuentas/create/{empresa_id}', \App\Livewire\CuentaCreate::class)->name('cuentas.create');
    Route::get('/cuentas/edit/{id}', \App\Livewire\CuentaEdit::class)->name('cuentas.edit');
    Route::get('/cuentas/{empresa_id}', \App\Livewire\CuentasView::class)->name('cuentas.view');

    // Rutas de Pólizas
    Route::get('/polizas/{empresa_id}/{cuenta_id}', \App\Livewire\PolizasView::class)->name('polizas.view');
    
    // Rutas de Tipos de Pólizas - Corrige el orden para evitar conflictos
    Route::get('/tipos-polizas/create/{empresa_id}', \App\Livewire\TipoPolizaCreate::class)->name('tipos-polizas.create');
    Route::get('/tipos-polizas/edit/{id}', \App\Livewire\TipoPolizaEdit::class)->name('tipos-polizas.edit');
    Route::get('/tipos-polizas/{empresa_id}', \App\Livewire\TiposPolizasView::class)->name('tipos-polizas.view');
});

Route::get('/check-table', function () {
    if (Schema::hasTable('tipos_polizas')) {
        return 'La tabla tipos_polizas existe.';
    } else {
        return 'La tabla tipos_polizas no existe.';
    }
});

