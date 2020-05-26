<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Game extends Component
{
    public const ROCK = 'rock';
    public const PAPER = 'paper';
    public const SCISSORS = 'scissors';

    private const BEATS = [
        self::ROCK => self::SCISSORS,
        self::SCISSORS => self::PAPER,
        self::PAPER => self::ROCK,
    ];

    private const WIN = 'win';
    private const LOSS = 'loss';
    private const DRAW = 'draw';

    public ?string $userChoice;
    public ?string $opponentChoice;
    public ?string $userResult;
    public ?string $opponentResult;

    public bool $isGameEnded = false;

    public function mount(): void
    {
    }

    public function choose($choice): void
    {
        $this->userChoice = $choice;
        $this->opponentChoice = $this->getRandomChoice();
        $this->userResult = $this->getUserResult();
        $this->opponentResult = $this->getOpponentResult();
        $this->isGameEnded = true;
    }

    public function render()
    {
        return view('livewire.game');
    }

    private function getRandomChoice(): string
    {
        $randomIndex = random_int(0, 2);
        return [self::ROCK, self::PAPER, self::SCISSORS][$randomIndex];
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
            return self::DRAW;
        }

        return self::BEATS[$choice1] === $choice2 ? self::WIN : self::LOSS;
    }
}
