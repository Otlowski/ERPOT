<?php

use Illuminate\Database\Seeder;
use App\Models\Questionnaires\QuestionnaireItem;
use App\Models\Questionnaires\Questionnaire;

class QuestionnairesItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('questionnaires_items')->delete();
        
        $faker = \Faker\Factory::create();
        
        $questionnaires = Questionnaire::all()->toArray();

        $limit = rand(10, 100);
        
        for ($i = 0; $i < $limit; $i++) {
            
            $questionnaireIndex = array_rand($questionnaires);
            $questionnaireObjectId = $questionnaires[$questionnaireIndex]['object_id'];
            
            $parameters = [
                'questionnaires__object_id'            =>      $questionnaireObjectId,
                'value'                                =>      $faker->word,
            ];
            
            $questionnaireItem = new QuestionnaireItem($parameters);
            $questionnaireItem->save();
        }
    }
}
