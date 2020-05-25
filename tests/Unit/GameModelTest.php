<?php

namespace Tests\Unit;

use App\Models\Game;
use App\ValueObjects\Choice;
use PHPUnit\Framework\TestCase;

class GameModelTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testAddUser()
    {
        $game = new Game('abcd');

        $userId = 'x';
        $game->addUser($userId);

        $users = $game->getGameState()['users'];
        $this->assertCount(1, $users);
        $this->assertArrayHasKey($userId, $users);
    }

    public function testAddUserTwice()
    {
        $game = new Game('abcd');

        $userId = 'x';
        $game->addUser($userId);
        $game->addUser($userId);

        $users = $game->getGameState()['users'];
        $this->assertCount(1, $users);
        $this->assertArrayHasKey($userId, $users);
    }

    public function testAddTwoUser()
    {
        $game = new Game('abcd');

        $userId1 = 'x';
        $game->addUser($userId1);

        $userId2 = 'y';
        $game->addUser($userId2);

        $users = $game->getGameState()['users'];
        $this->assertCount(2, $users);
        $this->assertArrayHasKey($userId1, $users);
        $this->assertArrayHasKey($userId2, $users);
    }

    public function testAddMoreThenTwoUsers()
    {
        $game = new Game('abcd');

        $game->addUser('x');
        $game->addUser('y');

        $this->expectException(\LogicException::class);
        $game->addUser('z');
    }

    public function testGetGameState()
    {
        $game = new Game('abcd');

        $game->addUser('x');
        $game->addUser('y');

        $game->setUserChoice('x', Choice::rock());
        $game->setUserChoice('y', Choice::scissors());

        $expectedGameState = [
            'id' => 'abcd',
            'users' => [
                'x' => Choice::ROCK,
                'y' => Choice::SCISSORS,
            ],
        ];

        $this->assertEquals($expectedGameState, $game->getGameState());
    }

    public function testCreateFromState()
    {
        $gameState = [
            'id' => 'abcd',
            'users' => [
                'x' => 'rock',
                'y' => 'paper',
            ],
        ];

        $game = Game::fromGameState($gameState);

        $this->assertEquals($gameState, $game->getGameState());
    }
}
