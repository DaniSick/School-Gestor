<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterForm extends Component
{
    public $name, $ap1, $ap2, $email, $curp, $sexo, $password;

    public function register()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'ap1' => 'required|string|max:255',
            'ap2' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'curp' => 'required|string|unique:users,curp',
            'sexo' => 'required|string',
            'password' => 'required|min:8',
        ]);

        User::create([
            'name' => $this->name,
            'ap1' => $this->ap1,
            'ap2' => $this->ap2,
            'email' => $this->email,
            'curp' => $this->curp,
            'sexo' => $this->sexo,
            'id_rol' => 1, // Ajusta este valor según tu tabla de roles
            'password' => Hash::make($this->password),
        ]);

        session()->flash('success', 'Usuario registrado con éxito. Por favor, inicia sesión.');
        return redirect()->route('login'); // Redirige al login
    }

    public function render()
    {
        return view('livewire.auth.register-form');
    }
}
