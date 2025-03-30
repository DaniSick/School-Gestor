<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class LoginForm extends Component
{
    public $email, $password;

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            return redirect()->route('dashboard');
        } else {
            session()->flash('error', 'Credenciales incorrectas.');
        }
    }

    public function render()
    {
        return view('livewire.auth.login-form');
    }
}
