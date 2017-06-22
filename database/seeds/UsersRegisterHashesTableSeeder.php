<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Users\UserRegisterHash;
use App\Models\Users\User;

class UsersRegisterHashesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users_register_hashes')->delete();
        
        $faker = \Faker\Factory::create();
        
        $users = User::all()->toArray();
        
        $limit = rand(10, 100);
        
        for ($i = 0; $i < $limit; $i++) {
        
            $start_at = Carbon::now();
            $start_at->subMinutes($faker->numberBetween(0, 40));
            
            $userIndex = array_rand($users);
            $userObjectId = $users[$userIndex]['object_id'];
            
            $parameters = [
                'users__object_id'      =>      $userObjectId,
                'hash'                  =>      hash('sha512', $faker->word),
                'start_at'              =>      $start_at,
                'finish_at'             =>      $start_at->copy()->addHour()
            ];
            
            $userRegisterHash = new UserRegisterHash($parameters);
            $userRegisterHash->save();
        }
    }
}
