<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('loged_successful_at');
            $table->dropColumn('login_failed_at');
            $table->dropColumn('blocked_at');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('blocked_at')->nullable()->after('status');
            $table->timestamp('login_failed_at')->nullable()->after('status');
            $table->timestamp('loged_successful_at')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('loged_successful_at');
            $table->dropColumn('login_failed_at');
            $table->dropColumn('blocked_at');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->date('blocked_at')->after('status');
            $table->date('login_failed_at')->after('status');
            $table->date('loged_successful_at')->after('status');
        });
    }
}
