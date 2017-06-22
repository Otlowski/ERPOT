<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('users__object_id');
            $table->timestamp('start_at');
            $table->timestamp('finish_at');
            $table->string('hash', 255);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users_sessions');
    }
    
}
