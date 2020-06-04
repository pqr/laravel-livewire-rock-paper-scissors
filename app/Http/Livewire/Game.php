<?php

namespace App\Http\Livewire;

use App\Models\Game as GameModel;
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

    public ?string $userChoice = null;
    public ?string $opponentChoice = null;

    /**
     * @var GameModel
     */
    public $game;

    public function mount(GameModel $game): void
    {
        $this->game = $game;
        $payers = $this->game->players;

        if (isset($payers[0])) {
            $this->userChoice = $payers[0]->choice;
        }

        if (isset($payers[1])) {
            $this->opponentChoice = $payers[1]->choice;
        }
    }

    public function choose($choice): void
    {
        $this->userChoice = $choice;
        $this->opponentChoice = $this->getRandomChoice();

        $this->game->gameover = true;
        $this->game->save();

        $this->game->players()->createMany(
            [
                ['choice' => $this->userChoice],
                ['choice' => $this->opponentChoice],
            ]
        );
    }

    public function render()
    {
        return view(
            'livewire.game',
            [
                'gameover' => $this->game->gameover,
                'userResult' => $this->getUserResult(),
                'opponentResult' => $this->getOpponentResult(),
            ]
        );
    }

    private function getRandomChoice(): string
    {
        $randomIndex = random_int(0, 2);
        return [self::ROCK, self::PAPER, self::SCISSORS][$randomIndex];
    }

    private function getUserResult(): ?string
    {
        return $this->getResult($this->userChoice, $this->opponentChoice);
    }

    private function getOpponentResult(): ?string
    {
        return $this->getResult($this->opponentChoice, $this->userChoice);
    }

    private function getResult(?string $choice1, ?string $choice2): ?string
    {
        if (!$choice1 || !$choice2) {
            return null;
        }

        if ($choice1 === $choice2) {
            return self::DRAW;
        }

        return self::BEATS[$choice1] === $choice2 ? self::WIN : self::LOSS;
    }
}
