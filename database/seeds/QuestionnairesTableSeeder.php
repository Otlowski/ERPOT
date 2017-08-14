<?php

use Illuminate\Database\Seeder;
use App\Models\Questionnaires\Questionnaire;
use App\Models\Trainings\TrainingContent;

class QuestionnairesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    private static $statuses = [
        'finished', 
        'not finished', 
        'cancelled'
    ];
    
    public function run()
    {
        \DB::table('questionnaires')->delete();
        
        $faker = \Faker\Factory::create();
        
        $trainingsContents = TrainingContent::all()->toArray();
        
        $limit = rand(10, 100);
        
        for ($i = 0; $i < $limit; $i++) {
            
            $description = 'This questionnaire concerns '.$faker->text(50);
            
            $trainingContentIndex = array_rand($trainingsContents);
            $trainingContentId = $trainingsContents[$trainingContentIndex]['id'];
            
            $parameters = [
                'trainings_contents__id'          =>      $trainingContentId,
                'name'                            =>      'some questionnaire',
                'description'                     =>      $description,
                'status'                          =>      self::$statuses[array_rand(QuestionnairesTableSeeder::$statuses)],
                'source'                          =>      $faker->url
            ];
            
            $questionnaire = new Questionnaire($parameters);
            $questionnaire->object_id = $questionnaire->setObjectId();
            $questionnaire->save();
        }
    }
}
