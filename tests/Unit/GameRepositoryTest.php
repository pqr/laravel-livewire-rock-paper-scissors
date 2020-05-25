<?php

namespace Tests\Unit;

use App\Models\Game;
use App\Repositories\GameRepository;
use App\ValueObjects\Choice;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\TestCase;
use Tests\CreatesApplication;

class GameRepositoryTest extends TestCase
{
    use CreatesApplication;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testSave()
    {
        $this->createApplication();

        $game = new Game('abcd');
        $game->addUser('x');
        $game->setUserChoice('x', Choice::rock());
        $game->addUser('y');
        $game->setUserChoice('y', Choice::paper());

        $filesystem = Storage::fake();

        $repo = new GameRepository($filesystem);

        $repo->save($game);

        Storage::assertExists('abcd.json');
    }
}
