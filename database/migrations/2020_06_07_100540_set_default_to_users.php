<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetDefaultToUsers extends Migration
{
    public function up()
    {
        Schema::table(
            'users',
            function (Blueprint $table) {
                $table->string('name')->default('')->change();
                $table->string('email')->default(null)->nullable()->change();
                $table->string('password')->default('')->change();
            }
        );
    }

    public function down()
    {
        Schema::table(
            'users',
            function (Blueprint $table) {
                //
            }
        );
    }
}
