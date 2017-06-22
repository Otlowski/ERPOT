<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingsEventsContentsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('trainings_events_contents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trainings_events__id')->unsigned();
            $table->integer('trainings_contents__id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
        
        Schema::table('trainings_events_contents', function (Blueprint $table) {
             $table->foreign('trainings_events__id')->references('id')->on('trainings_events');
             $table->foreign('trainings_contents__id')->references('id')->on('trainings_contents');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() { {
            Schema::drop('trainings_events_contents');
        }
    }

}
