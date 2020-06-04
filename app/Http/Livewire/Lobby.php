<?php

namespace App\Http\Livewire;

use App\Models\Game as GameModel;
use Livewire\Component;

class Lobby extends Component
{
    public function newGame()
    {
        $game = GameModel::create();
        return redirect(route('game', $game));
    }

    public function render()
    {
        return view('livewire.lobby');
    }
}
