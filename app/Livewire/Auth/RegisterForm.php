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
            'curp' => 'nullable|string|unique:users,curp|regex:/^[A-Z0-9]{18}$/', // Hacer el campo nullable
            'sexo' => 'required|in:1,2',
            'password' => 'required|min:8',
        ]);

        User::create([
            'name' => $this->name,
            'ap1' => $this->ap1,
            'ap2' => $this->ap2,
            'email' => $this->email,
            'curp' => $this->curp, // Puede ser null
            'sexo' => $this->sexo,
            'id_rol' => 2, // Rol predeterminado de "User"
            'password' => Hash::make($this->password),
        ]);

        session()->flash('success', 'Usuario registrado con éxito. Por favor, inicia sesión.');
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.auth.register-form');
    }
}
