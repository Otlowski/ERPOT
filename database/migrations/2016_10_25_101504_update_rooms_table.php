<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->string('rooms_groups__id')->nullable()->after('id'); 
            $table->string('floor')->after('number');  
            $table->string('description')->after('floor');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn('rooms_groups__id');
            $table->dropColumn('floor');
            $table->dropColumn('description');
         });
    }
}
