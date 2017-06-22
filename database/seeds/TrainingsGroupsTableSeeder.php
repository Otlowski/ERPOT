<?php

use Illuminate\Database\Seeder;
use App\Models\Trainings\TrainingGroup;

class TrainingsGroupsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        \DB::table('trainings_groups')->delete();

        $faker = \Faker\Factory::create();

        $groupsNames = [
            'Siemens TC',
            'AutoCad',
            'Sap Business One',
            'Sap Pronovia',
            'MSH Processes',
            'MSH HQM',
            'MSH Materials'
        ];
        
        foreach ($groupsNames as $groupName) {

            $name = $groupName;
            $description = 'This ' .$name. ' group helps you with : '.$faker->text(20);
            $parameters = [
                'name' => $name,
                'description' => $description
            ];

            $trainingGroup = new TrainingGroup($parameters);
            $trainingGroup->save();
        }
    }

}
