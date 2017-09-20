<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTrainingsNotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trainings_notes', function($table) {
            $table->string('author')->after('note'); 
            $table->renameColumn('trainings__object_id', 'trainings_contents__id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trainings_notes', function($table) {
            $table->dropColumn('author'); 
            $table->renameColumn('trainings_contents__id', 'trainings__object_id');
        });
    }
}
