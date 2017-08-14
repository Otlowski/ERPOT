<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('revision');
            $table->string('object_id');
            $table->string('rooms__object_id');
            $table->integer('trainings_contents__id');
            $table->integer('seats_amount');
            $table->integer('seats_left');
            $table->timestamp('start_at');
            $table->timestamp('finish_at');
            $table->string('status');
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
        Schema::drop('trainings');
    }
}
