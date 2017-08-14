<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Users\UserMail;
use App\Models\Users\User;

class UsersMailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users_mails')->delete();
        
        $faker = \Faker\Factory::create();
        
        $users = User::all()->toArray();
        
        $limit = rand(10, 100);
        
        for ($i = 0; $i < $limit; $i++) {
            
            $userIndex = array_rand($users);
            $userObjectId = $users[$userIndex]['object_id'];
            
            $parameters = [
                'users__object_id'      =>      $userObjectId,
                'send_date'             =>      $faker->dateTimeThisDecade,
                'subject'               =>      $faker->word,
                'message'               =>      $faker->text($maxNbChars = 200)
            ];
            
            $userMail = new UserMail($parameters);
            $userMail->save();
        }
    }
}
