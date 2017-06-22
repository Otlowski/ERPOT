<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTrainingsContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trainings_contents', function (Blueprint $table) {
            $table->dropColumn('questionnaires__object_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trainings_contents', function (Blueprint $table) {
            $table->integer('questionnaires__object_id')->after('id');
        });
    }
}
