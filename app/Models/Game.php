<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Game
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property bool $gameover
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Player[] $players
 * @property-read int|null $players_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game whereGameover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Game extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gameover',
    ];

    protected $casts = [
        'gameover' => 'boolean',
    ];

    protected $withCount = ['players'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function players()
    {
        return $this->hasMany(\App\Models\Player::class);
    }

    public function isMine(int $userId)
    {
        return (bool)$this->players->firstWhere('user_id', $userId);
    }



    public function joinIfPossible(int $userId)
    {
        if ($this->players_count >= 2) {
            return;
        }

        if ($this->isMine($userId)) {
            return;
        }

        $this->players()->create(['user_id' => $userId]);
        $this->load('players');
    }

    public function getMyChoice(int $userId): ?string
    {
        $me = $this->players->firstWhere('user_id', $userId);
        if (!$me) {
            throw new \Exception('Not in the game');
        }

        return $me->choice;
    }

    public function getOpponentChoice(int $userId): ?string
    {
        $opponent = $this->players->firstWhere('user_id', '!=', $userId);
        if (!$opponent) {
            return null;
        }

        return $opponent->choice;
    }

    public function makeUserChoice(int $userId, string $choice): void
    {
        if (!$this->isMine($userId)) {
            throw new \Exception('Not my game');
        }

        $me = $this->players->firstWhere('user_id', $userId);
        $me->choice = $choice;
        $me->save();

        if ($this->getOpponentChoice($userId)) {
            $this->gameover = true;
            $this->save();
        }
    }
}
