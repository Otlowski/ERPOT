<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionnairesFeedbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionnaires_feedbacks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('questionnaires_items__id');
            $table->string('users__object_id');
            $table->string('value');
            $table->string('username');
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
        Schema::drop('questionnaires_feedbacks');
    }
}
