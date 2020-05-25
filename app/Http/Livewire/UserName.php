<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UserName extends Component
{
    public string $name = '';

    public function mount()
    {
        $this->name = session('UserName', '');
    }

    public function updatedName()
    {
        session(['UserName' => $this->name]);
    }

    public function render()
    {
        return view('livewire.user-name');
    }
}
