<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRoomsTable3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn('localization');
            $table->string('location')->after('free_seats_amount');  
//            $table->string('address1')->after('free_seats_amount');  
//            $table->string('address2')->after('address1');  
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
            $table->dropColumn('location');
            $table->string('localization');
            
//            $table->string('address1')->after('free_seats_amount');  
//            $table->string('address2')->after('address1'); 
        });
    }
}
