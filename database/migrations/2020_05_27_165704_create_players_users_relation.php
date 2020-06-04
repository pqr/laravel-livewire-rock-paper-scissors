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
 * @tag     laravel-schematics-users-relation
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersUsersRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('players', static function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
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
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}
