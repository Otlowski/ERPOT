<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTrainingsChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trainings_chapters', function (Blueprint $table) {
            $table->string('name')->nullable()->after('value'); 
            $table->string('description')->nullable()->after('name');//
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trainings_chapters', function (Blueprint $table) {
            $table->dropColumn('name'); 
            $table->dropColumn('description'); 
        });
    }
}
