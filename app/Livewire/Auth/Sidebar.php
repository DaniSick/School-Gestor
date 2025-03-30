<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\Menu;

class Sidebar extends Component
{
    public $menus;

    public function mount()
    {
        $this->menus = Menu::whereNull('parent_id')->with('children')->get();
    }

    public function render()
    {
        return view('livewire.auth.sidebar', ['menus' => $this->menus]);
    }
}
