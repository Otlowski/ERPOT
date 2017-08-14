<?php

use Illuminate\Database\Seeder;
use App\Models\Trainings\TrainingLeader;
use App\Models\Users\User;
use App\Models\Trainings\Training;

class TrainingsLeadresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('trainings_leaders')->delete();
        
        $faker = \Faker\Factory::create();
        
        $users = User::all()->toArray();
        
        $trainings = Training::all()->toArray();
        
        $limit = rand(10, 100);
        
        for ($i = 0; $i < $limit; $i++) {
            
            $userIndex = array_rand($users);
            $userObjectId = $users[$userIndex]['object_id'];
            
            $trainingIndex = array_rand($trainings);
            $trainingObjectId = $trainings[$trainingIndex]['object_id'];
            
            $parameters = [
                'users__object_id'                 =>      $userObjectId,
                'trainings__object_id'             =>      $trainingObjectId
            ];
            
            $trainingLeader = new TrainingLeader($parameters);
            $trainingLeader->save();
        }
    }
}
