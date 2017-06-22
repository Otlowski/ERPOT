<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingsEventsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('trainings_events_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trainings_events__id')->unsigned();
            $table->integer('trainings_users__id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
        
         Schema::table('trainings_events_users', function (Blueprint $table) {
             $table->foreign('trainings_events__id')->references('id')->on('trainings_events');
             $table->foreign('trainings_users__id')->references('id')->on('trainings_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('trainings_events_users');
    }
}
