<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Trainings\TrainingUser;
use App\Models\Users\User;
use App\Models\Trainings\Training;

class TrainingsUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('trainings_users')->delete();
        
        $faker = \Faker\Factory::create();
        
        $users = User::all()->toArray();
        
        $trainings = Training::all()->toArray();
        
        $limit = rand(700, 1000);
        
        for ($i = 0; $i < $limit; $i++) {
        
            $userIndex = array_rand($users);
            $userObjectId = $users[$userIndex]['object_id'];
            
            $trainingIndex = array_rand($trainings);
            $trainingObjectId = $trainings[$trainingIndex]['object_id'];
            
            $presence_confirmation = Carbon::now();
            
            $parameters = [
                
                'users__object_id'                 =>      $userObjectId,
                'trainings__object_id'             =>      $trainingObjectId,
                'presence_confirmation'            =>      $presence_confirmation
            ];
            
            $trainingUser = new TrainingUser($parameters);
            $trainingUser->save();
        }
    }
}
