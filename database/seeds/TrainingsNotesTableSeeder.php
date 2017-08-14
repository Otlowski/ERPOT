<?php

use Illuminate\Database\Seeder;
use App\Models\Trainings\TrainingNote;
use App\Models\Trainings\Training;

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
        
        $trainings = Training::all()->toArray();
        
        $limit = rand(10, 100);
        
        for ($i = 0; $i < $limit; $i++) {
            
            $trainingIndex = array_rand($trainings);
            $trainingObjectId = $trainings[$trainingIndex]['object_id'];
            
            $parameters = [
                'trainings__object_id'               =>      $trainingObjectId,
                'note'                               =>      $faker->text($maxNbChars = 200)
            ];
            
            $trainingNote = new TrainingNote($parameters);
            $trainingNote->save();
        }
    }
}
