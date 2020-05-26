<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Game extends Component
{
    private const OPTIONS = ['Rock', 'Paper', 'Scissors️'];

    private const BEATS = [
        'Rock' => 'Scissors',
        'Scissors' => 'Paper',
        'Paper' => 'Rock',
    ];

    public ?string $userChoice;
    public ?string $opponentChoice;
    public ?string $userResult;
    public ?string $opponentResult;

    public bool $gameEnded = false;

    public function mount(): void
    {
        $this->opponentChoice = $this->getRandomChoice();
    }

    public function choose($choice): void
    {
        $this->userChoice = $choice;
        $this->userResult = $this->getUserResult();
        $this->opponentResult = $this->getOpponentResult();
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

    private function getUserResult(): string
    {
        return $this->getResult($this->userChoice, $this->opponentChoice);
    }

    private function getOpponentResult(): string
    {
        return $this->getResult($this->opponentChoice, $this->userChoice);
    }

    private function getResult(string $choice1, string $choice2): string
    {
        if ($choice1 === $choice2) {
            return 'draw';
        }

        return self::BEATS[$choice1] === $choice2 ? 'win' : 'loss';
    }
}
