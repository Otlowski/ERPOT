<?php

use Illuminate\Database\Seeder;
use App\Models\Trainings\TrainingDocument;
use App\Models\Trainings\TrainingContent;

class TrainingsDocumentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private static $documentsTypes = [
        'chart',
        'diagram',
        'illustration',
        'instruction',
        'note',
        'annotation',
        'video'
    ];

    public function run()
    {
        \DB::table('trainings_documents')->delete();

        $faker = \Faker\Factory::create();

        $trainingsContents = TrainingContent::all()->toArray();

        $limit = rand(10, 100);

        for ($i = 0; $i < $limit; $i++) {

            $documentType = self::$documentsTypes[array_rand(TrainingsDocumentsTableSeeder::$documentsTypes)];
            $name = 'test'.$i.'.pdf';
            $description = $documentType.' shows '.$faker->text(50);

            $trainingContentIndex = array_rand($trainingsContents);
            $trainingContentId = $trainingsContents[$trainingContentIndex]['id'];

            $parameters = [
                'trainings_contents__id'             =>      $trainingContentId,
                'name'                               =>      $name,
                'description'                        =>      $description,
                'source'                             =>      $faker->url
            ];

            $trainingDocument = new TrainingDocument($parameters);
            $trainingDocument->save();
        }
    }
}
