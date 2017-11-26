<?php

use Illuminate\Database\Seeder;
use App\Models\Trainings\TrainingNote;
use App\Models\Trainings\TrainingContent;

class TrainingsNotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('trainings_notes')->delete();
        
        $faker = \Faker\Factory::create();
        
        $trainings = TrainingContent::all()->toArray();
        
        $limit = rand(10, 100);
        
        for ($i = 0; $i < $limit; $i++) {
            
            $trainingIndex = array_rand($trainings);
            $trainingObjectId = $trainings[$trainingIndex]['id'];
            
            $parameters = [
                'trainings_contents__id'               =>      $trainingObjectId,
                'note'                                 =>      $faker->text($maxNbChars = 200),
                'author'                               =>      $faker->text($maxNbChars = 10)
                
            ];
            
            $trainingNote = new TrainingNote($parameters);
            $trainingNote->save();
        }
    }
}
