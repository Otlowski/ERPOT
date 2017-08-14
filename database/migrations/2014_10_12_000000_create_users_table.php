<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('revision');
            $table->string('object_id');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password', 255);
            $table->string('firstname');
            $table->string('lastname');
            $table->string('name');
            $table->boolean('is_admin');
            $table->enum('status', ['inactivated', 'activated', 'blocked', 'archichived']);
            $table->string('session_hash', 255);
            $table->date('loged_successful_at');
            $table->date('login_failed_at');
            $table->date('blocked_at');
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
        Schema::drop('users');
    }
}
