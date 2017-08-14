<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_mails', function (Blueprint $table) {
            $table->dropColumn('send_date');
        });
        Schema::table('users_mails', function (Blueprint $table) {
            $table->timestamp('send_date')->after('users__object_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_mails', function (Blueprint $table) {
            $table->dropColumn('send_date');
        });
        Schema::table('users_mails', function (Blueprint $table) {
            $table->date('send_date')->after('users__object_id');
        });
    }
}
