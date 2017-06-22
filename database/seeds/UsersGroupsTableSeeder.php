<?php

use Illuminate\Database\Seeder;
use App\Models\Users\UserGroup;

class UsersGroupsTableSeeder extends Seeder
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
            'Bussines Gurus',
            'Web Dev. Team',
            'Java Developers',
            'Designers',
        ];
        
        foreach ($groupsNames as $groupName) {

            $name = $groupName;
            $description = 'This ' .$name. ' group: '.$faker->text(20);
            $parameters = [
                'name' => $name,
                'description' => $description
            ];

            $userGroup = new UserGroup($parameters);
            $userGroup->save();
        }
    }
    
}
