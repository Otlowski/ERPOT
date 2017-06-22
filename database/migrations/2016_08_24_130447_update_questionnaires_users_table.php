<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateQuestionnairesUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questionnaires_users', function (Blueprint $table) {
            $table->string('questionnaires__object_id')->after('id');
            $table->dropColumn('result');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questionnaires_users', function (Blueprint $table) {
            $table->dropColumn('questionnaires__object_id');
            $table->double('result');
        });
    }
}
