<?php

use Illuminate\Database\Seeder;
use App\Models\Questionnaires\QuestionnaireUser;
use App\Models\Questionnaires\Questionnaire;
use App\Models\Users\User;
use App\Models\Trainings\TrainingUser;

class QuestionnairesUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    private static $statuses = [
        'finished',
        'not finished',
        'void'
    ];
    
    public function run()
    {
        \DB::table('questionnaires_users')->delete();
        
        $faker = \Faker\Factory::create();
        
        $questionnaires = Questionnaire::all()->toArray();
        
        $users = User::all()->toArray();
        
        $trainingsUsers = TrainingUser::all()->toArray();
        
        $limit = rand(400, 800);
        
        for ($i = 0; $i < $limit; $i++) {
            
            //$status = self::$statuses[array_rand(QuestionnairesUsersTableSeeder::$statuses)];
            
            $status = 'finished';
            if ($faker->boolean(13)) {
                $status = 'not finished';
            }
            
            $questionnaireIndex = array_rand($questionnaires);
            $questionnaireObjectId = $questionnaires[$questionnaireIndex]['object_id'];
            
            $userIndex = array_rand($users);
            $userObjectId = $users[$userIndex]['object_id'];
            
            $trainingUserIndex = array_rand($trainingsUsers);
            $trainingUserId = $trainingsUsers[$trainingUserIndex]['id'];
            
            $parameters = [
                'questionnaires__object_id'            =>      $questionnaireObjectId,
                'users__object_id'                     =>      $userObjectId,
                'trainings_users__id'                  =>      $trainingUserId,
                'status'                               =>      $status
            ];
            
            $questionnaireUser = new QuestionnaireUser($parameters);
            $questionnaireUser->save();
        }
    }
}
