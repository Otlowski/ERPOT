<?php

use Illuminate\Database\Seeder;
use App\Models\Trainings\TrainingContent;
use App\Models\Trainings\TrainingGroup;

class TrainingsContentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    private static $trainingTypes = [
        'databases',
        'HTML',
        'php',
        'managment skills',
        'organisation of work'
    ];
    
    public function run()
    {
        \DB::table('trainings_contents')->delete();
        
        $faker = \Faker\Factory::create();
        
        $trainingsGroups = TrainingGroup::all()->toArray();
        $limit = rand(10, 100);
        
        for ($i = 0; $i < $limit; $i++) {
            
            $trainingGroupIndex = array_rand($trainingsGroups);
            $trainingGroupId = $trainingsGroups[$trainingGroupIndex]['id'];
            
            $trainingType = self::$trainingTypes[array_rand(TrainingsContentsTableSeeder::$trainingTypes)];
            $name = $trainingType.' training';
            $description = 'This '.$name.' concerns '.$faker->text(50);
            
            
            $parameters = [
                'trainings_groups__id'   =>      $trainingGroupId,
                'name'                   =>      $name,
                'description'            =>      $description
            ];
            
            $trainingContent = new TrainingContent($parameters);
            $trainingContent->save();
        }
    }
}
