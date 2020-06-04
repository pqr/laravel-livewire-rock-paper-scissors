<?php

/**
 * Laravel Schematics
 *
 * WARNING: removing @tag value will disable automated removal
 *
 * @package Laravel-schematics
 * @url     https://github.com/mtolhuys/laravel-schematics
 * @author  Maarten Tolhuijs <mtolhuys@protonmail.com>
 * @tag     laravel-schematics-players-relation
 * @tag     laravel-schematics-games-relation
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersGamesRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('players', static function (Blueprint $table) {
            $table->foreign('game_id')->references('id')->on('games');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('players', static function (Blueprint $table) {
            $table->dropForeign(['game_id']);
        });
    }
}
