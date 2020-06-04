<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGameoverToGames extends Migration
{
    public function up()
    {
        Schema::table(
            'games',
            function (Blueprint $table) {
                $table->boolean('gameover')->default(false);
            }
        );
    }

    public function down()
    {
        Schema::table(
            'games',
            function (Blueprint $table) {
                $table->dropColumn('gameover');
            }
        );
    }
}
