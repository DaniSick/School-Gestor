<?php

namespace App\Livewire;

use Livewire\Component;

class PolizasView extends Component
{
    public $empresa_id;
    public $cuenta_id;

    public function mount($empresa_id, $cuenta_id)
    {
        $this->empresa_id = $empresa_id;
        $this->cuenta_id = $cuenta_id;
    }

    public function render()
    {
        return view('livewire.polizas-view', [
            'empresa_id' => $this->empresa_id,
            'cuenta_id' => $this->cuenta_id,
        ]);
    }
}
