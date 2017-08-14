<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTrainingsUsersTable2 extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('trainings_users', function($table) {
            $table->renameColumn('trainings__object_id', 'trainings_events__object_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('trainings_users', function($table) {
            $table->renameColumn('trainings_events__object_id', 'trainings__object_id');
        });
    }

}
