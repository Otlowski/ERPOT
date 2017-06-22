<?php

use Illuminate\Database\Seeder;
use App\Models\Rooms\Room;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('rooms')->delete();
        
        $faker = \Faker\Factory::create();
                
        $limit = rand(10, 100);
        
        for ($i = 0; $i < $limit; $i++) {
            
            $freeSeatsAmount = $faker->numberBetween(3, 20) * 10;
            $randId  = rand(1,6);
            $parameters = [
                'rooms_groups__id'            =>      $randId,
                'free_seats_amount'           =>      $freeSeatsAmount,
                'location'                    =>      $faker->address,
                'number'                      =>      $faker->numberBetween(1, 250),
                'floor'                       =>      $faker->numberBetween (-2,15)
            ];
            
            $room = new Room($parameters);
            $room->object_id = $room->setObjectId();
            $room->save();
        }
    }
}
