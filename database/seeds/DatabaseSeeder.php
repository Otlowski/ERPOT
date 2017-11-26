<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        $variable = 20;
        /*
         * Users seeds
         */
        // $this->call(UsersTableSeeder::class);
        // $this->call(UsersMailsTableSeeder::class);
        // $this->call(UsersRegisterHashesTableSeeder::class);
        // $this->call(UsersSessionsTableSeeder::class);
        // $this->call(UsersGroupsTableSeeder::class);

        /*
         * Rooms seeds
         */
        // $this->call(RoomsTableSeeder::class);
        // $this->call(RoomsGroupsTableSeeder::class);

        /*
         * Trainings seeds
         */
        $this->call(TrainingsGroupsTableSeeder::class);
        $this->call(TrainingsContentsTableSeeder::class);
        // $this->call(TrainingsTableSeeder::class);
        $this->call(TrainingsNotesTableSeeder::class);
        // $this->call(TrainingsLeadresTableSeeder::class);
        // $this->call(TrainingsUsersTableSeeder::class);
         $this->call(TrainingsDocumentsTableSeeder::class);
        for($i = 0 ; $i < $variable ; $i++){
        $this->call(TrainingsChaptersTableSeeder::class);
        }

        /*
         * Questionnaires seeds
         */
        // $this->call(QuestionnairesTableSeeder::class);
        // $this->call(QuestionnairesItemsTableSeeder::class);
        // $this->call(QuestionnairesFeedbacksTableSeeder::class);
        // $this->call(QuestionnairesUsersTableSeeder::class);
        //

    }
}
