<?php

namespace App\Http\Livewire;

use App\Models\Game as GameModel;
use Illuminate\Support\Facades\Auth;
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

    /**
     * @var GameModel
     */
    public $game;

    public function mount(GameModel $game): void
    {
        $this->game = $game;

        $userId = Auth::id();
        $this->game->joinIfPossible($userId);
    }

    public function choose($choice): void
    {
        $this->game->makeUserChoice(Auth::id(), $choice);
    }

    public function render()
    {
        $userId = Auth::id();

        $isMine = $this->game->isMine($userId);
        if ($isMine) {
            $player1Choice = $this->game->getMyChoice($userId);
            $player2Choice = null;
            if ($this->game->gameover) {
                $player2Choice = $this->game->getOpponentChoice($userId);
            }
        } else {
            $player1Choice = $this->game->players[0]['choice'] ?? null;
            $player2Choice = $this->game->players[1]['choice'] ?? null;
        }

        return view(
            'livewire.game',
            [
                'gameover' => $this->game->gameover,
                'isMine' => $isMine,
                'player1Choice' => $player1Choice,
                'player2Choice' => $player2Choice,
                'player1Result' => $this->getResult($player1Choice, $player2Choice),
                'player2Result' => $this->getResult($player2Choice, $player1Choice),
            ]
        );
    }

    private function getRandomChoice(): string
    {
        $randomIndex = random_int(0, 2);
        return [self::ROCK, self::PAPER, self::SCISSORS][$randomIndex];
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
