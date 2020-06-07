<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserName extends Component
{
    public string $name = '';

    public function mount()
    {
        $this->name = Auth::user()->name ?? '';
    }

    public function updatedName()
    {
        Auth::user()->update(['name' => $this->name]);
    }

    public function render()
    {
        return view('livewire.user-name');
    }
}
