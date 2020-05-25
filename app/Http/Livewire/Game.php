<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Game extends Component
{
    private const OPTIONS = ['Rock', 'Paper', 'Scissors'];

    private const BEATS = [
        'Rock' => 'Scissors',
        'Scissors' => 'Paper',
        'Paper' => 'Rock',
    ];

    public ?string $userChoice;
    public ?string $opponentChoice;
    public ?string $userResult;

    public bool $gameEnded = false;

    public function mount()
    {
        $this->opponentChoice = $this->getRandomChoice();
    }

    public function choose($choice)
    {
        $this->userChoice = $choice;
        $this->userResult = $this->getUserResult();
        $this->gameEnded = true;
    }

    public function render()
    {
        return view('livewire.game');
    }

    private function getRandomChoice(): string
    {
        $randomIndex = random_int(0, 2);
        return self::OPTIONS[$randomIndex];
    }

    private function getUserResult()
    {
        if ($this->userChoice === $this->opponentChoice) {
            return 'draw';
        }

        return self::BEATS[$this->userChoice] === $this->opponentChoice ? 'win' : 'loss';
    }
}
