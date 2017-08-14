<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Users\UserSession;
use App\Models\Users\User;

class UsersSessionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users_sessions')->delete();
        
        $faker = \Faker\Factory::create();
        
        $users = User::all()->toArray();
        
        $limit = rand(10, 100);
        
        for ($i = 0; $i < $limit; $i++) {
        
            $start_at = Carbon::now();
            $start_at->subHours($faker->numberBetween(0, 2));
            $start_at->subMinutes($faker->numberBetween(0, 59));
            
            $finish_at = Carbon::now();
            $finish_at->addHours(2);
            
            $userIndex = array_rand($users);
            $userObjectId = $users[$userIndex]['object_id'];
            
            $parameters = [
                'users__object_id'      =>      $userObjectId,
                'start_at'              =>      $start_at,
                'finish_at'             =>      $finish_at,
                'hash'                  =>      hash('sha512', $faker->word)
            ];
            
            $userSession = new UserSession($parameters);
            $userSession->save();
        }
    }
}
