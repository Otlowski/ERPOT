<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTrainingsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('trainings', function (Blueprint $table) {
            $table->string('trainings_groups__id')->nullable()->after('id');  //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('trainings', function (Blueprint $table) {
            $table->dropColumn('trainings_groups__id'); 
        });
    }

}
