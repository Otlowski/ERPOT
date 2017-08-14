<?php

use Illuminate\Database\Seeder;
use App\Models\Rooms\RoomsGroups;

class RoomsGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $faker = \Faker\Factory::create();

        $groupsNames = [
            'Computing Labs',
            'Technology Labs',
            'Engineering Labs',
            'Robotics Labs',
            'Design Labs',
            'Assembly hall',
        ];
        
        foreach ($groupsNames as $groupName) {

            $name = $groupName;
            $description = 'This ' .$name. ' group: '.$faker->text(20);
            $parameters = [
                'name' => $name,
                'description' => $description
            ];

            $roomGroup = new RoomsGroups($parameters);
            $roomGroup->save();
        }
    }
}
