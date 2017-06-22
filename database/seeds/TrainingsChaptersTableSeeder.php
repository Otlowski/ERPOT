<?php

use Illuminate\Database\Seeder;
use App\Models\Trainings\TrainingChapter;
use App\Models\Trainings\TrainingContent;

class TrainingsChaptersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
//        \DB::table('trainings_chapters')->delete();

        $faker = \Faker\Factory::create();

        


        
        $randomName = [
            '0' => 'Getting Started',
            '1' => 'Types and expressions',
            '2' => 'Input&Output',
            '3' => 'Arrays',
            '4' => 'Structs',
            '5' => 'Functions',
        ];
        $mask = '000';
        $actualChapter = 1;
        

//        foreach ($trainingsContents as $content) {
            $trainingsContents = TrainingContent::all()->toArray();
            $limit = rand(0, 6);
            $trainingContentIndex = array_rand($trainingsContents);
            $slicedArray = array_slice($randomName, 0, $limit);
            foreach ($slicedArray as $name) {
                
                $content = $trainingsContents[$trainingContentIndex]['id'];
                
                $value  = $mask.$actualChapter;
                $shortValue = substr($value, -2);
                $parameters = [
                    'trainings_contents__id' => $content,
                    'name' => $name,
                    'description' => $faker->text(rand(100, 500)),
                    'value'       => $shortValue
                ];
                $actualChapter++;

                $trainingChapter = new TrainingChapter($parameters);
                $trainingChapter->save();
//            }
        }
    }

}
