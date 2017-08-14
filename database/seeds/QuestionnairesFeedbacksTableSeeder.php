<?php

use Illuminate\Database\Seeder;
use App\Models\Questionnaires\QuestionnaireFeedback;
use App\Models\Questionnaires\QuestionnaireItem;

class QuestionnairesFeedbacksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('questionnaires_feedbacks')->delete();
        
        $faker = \Faker\Factory::create();

        $questionnairesItems = QuestionnaireItem::all()->toArray();
        
        $limit = rand(10, 100);
        
        for ($i = 0; $i < $limit; $i++) {
            
            $questionnaireItemIndex = array_rand($questionnairesItems);
            $questionnaireItemId = $questionnairesItems[$questionnaireItemIndex]['id'];
            
            $parameters = [
                'questionnaires_items__id'            =>      $questionnaireItemId,
                'value'                               =>      $faker->word,
                'username'                            =>      $faker->userName
            ];
            
            $questionnaireFeedback = new QuestionnaireFeedback($parameters);
            $questionnaireFeedback->save();
        }
    }
}
