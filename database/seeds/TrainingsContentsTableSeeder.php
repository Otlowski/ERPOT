<?php

use Illuminate\Database\Seeder;
use App\Models\Trainings\TrainingContent;
use App\Models\Trainings\TrainingGroup;

class TrainingsContentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private static $trainingTypes = [
        'Photoshop',
        'Sketchup',
        'Autocad',
        'Gimp'
    ];

    private static $webTrainingTypes = [
        'HTML & CSS',
        'C#',
        'SQL',
        'Python',
        'JavaScript',
        'PHP',
    ];
    private static $softTrainingTypes = [
        'C',
        'C++',
        'Java EE',
        'Java & Android',
        'Objective C'
    ];


    public function run()
    {
        \DB::table('trainings_contents')->delete();

        $faker = \Faker\Factory::create();


        /*
         * Training Web Development
         */
        $trainingsWebGroups   = TrainingGroup::where('name','Web Development')->first();
        $trainingsWebGroupsId = $trainingsWebGroups->id;
        $webTrainingTypes     = self::$webTrainingTypes;
        $weblength            = count($webTrainingTypes);
        $webDescriptions = [
          "HTML & CSS are the basic building blocks of the website world! And this is the perfect course for you to dive right in and learn them.",
          'C# is a beautiful cross-platform language that can be used to build variety of applications. With C#, you can build mobile apps (for Windows, Android and iOS), games, web sites and desktop applications.',
          'This unique introductory SQL tutorial not only provides easy-to-understand SQL instructions, but it allows you to practice what you learn using the on-line SQL interpreter. You will receive immediate results after submitting your SQL commands.',
          'Get up and running with object-oriented programming by watching our Python tutorials.',
          'Learn about the functional concepts at the heart of many JavaScript frameworks and programs.',
          'PHP is a popular programming language that you can use to write simple code for web pages. If you have been using HTML to develop websites, learning PHP will allow you to create dynamic pages.'
        ];

        for ($i = 0; $i < $weblength; $i++) {

              $trainingsWebName = $webTrainingTypes[$i];
              $description      = $webDescriptions[$i];
              $parameters = [
                  'trainings_groups__id'   =>      $trainingsWebGroupsId,
                  'name'                   =>      $trainingsWebName,
                  'description'            =>      $description
              ];

              $trainingContent = new TrainingContent($parameters);
              $trainingContent->save();
        }

        /*
         * Training Software Development
         */
         $trainingsSoftGroups   = TrainingGroup::where('name','Software Development')->first();
         $trainingsSoftGroupsId = $trainingsSoftGroups->id;
         $softTrainingTypes     = self::$softTrainingTypes;
         $softlength            = count($softTrainingTypes);
         $softDescriptions = [
           "This course will teach you how to program in C, the programming language, from the ground up. ",
           'Erpot has C++ courses for any skill level. Learn C++ programming on Erpot and start your computer science career today!',
           'Java EE helps increase developer productivity. This scalable platform meets enterprise demands, enabling portable batch processing and more.',
           'Android is known to be one of the most versatile and most used operating systems. We are in the age where every other person uses a handheld device or a cell phone which makes use of Android',
           'Learn Objective C from real world experts. Discover courses now and start learning.'
         ];
         for ($i = 0; $i < $softlength; $i++) {

               $trainingsSoftName = $softTrainingTypes[$i];
               $description       = $softDescriptions[$i];
               $parameters = [
                   'trainings_groups__id'   =>      $trainingsSoftGroupsId,
                   'name'                   =>      $trainingsSoftName,
                   'description'            =>      $description
               ];

               $trainingContent = new TrainingContent($parameters);
               $trainingContent->save();
         }

        /* Other Groups*/
        $trainingsGroups = TrainingGroup::whereNotIn('name',['Web Development', 'Software Development'])->get()->toArray();
        $limit = rand(5, 10);

        for ($i = 0; $i < $limit; $i++) {

            $trainingGroupIndex = array_rand($trainingsGroups);
            $trainingGroupId = $trainingsGroups[$trainingGroupIndex]['id'];

            $trainingType = self::$trainingTypes[array_rand(TrainingsContentsTableSeeder::$trainingTypes)];
            $name = $trainingType.' training';
            $description = 'This '.$name.' concerns '.$faker->text(50);

            $parameters = [
                'trainings_groups__id'   =>      $trainingGroupId,
                'name'                   =>      $name,
                'description'            =>      $description
            ];

            $trainingContent = new TrainingContent($parameters);
            $trainingContent->save();
        }
    }
}
