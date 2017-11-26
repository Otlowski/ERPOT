<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Users\User;

class UsersTableSeeder extends Seeder {
    
    private static $statuses = [
        'activated',
        'inactivated'
    ];
    
    public function run() {
        
        \DB::table('users')->delete();
        
        $faker = \Faker\Factory::create();
        
        $limit = rand(10, 100);
        
        for ($i = 0; $i < $limit; $i++) {
        
            $status = 'activated';
            if ($faker->boolean(10)) {
                $status = 'inactivated';
            }
            $randId = rand(0,4);
            $parameters = [
                'users_groups__id' =>      $randId,
                'username'         =>      $faker->unique()->username,
                'email'            =>      $faker->unique()->email,
                'password'         =>      hash('sha512', $faker->password),
                'password'         =>      $faker->password,
                'firstname'        =>      $faker->firstName,
                'lastname'         =>      $faker->lastName,
                'is_admin'         =>      0,
                'status'           =>      $status
                //self::$statuses[array_rand(UsersTableSeeder::$statuses)]
            ];
            
            $user = new User($parameters);
            $user->object_id = $user->setObjectId();
            $user->linkNames();
            $user->save();
        }
        
        
        
        
//        User::create([
//           'email'           =>      'kuba@t-media.pl',
//           'password'        =>      hash('sha512', 'userK')
//        ]);
//        
//        User::create([
//           'email'           =>      'maciej@t-media.pl',
//           'password'        =>      hash('sha512', 'userM')
//        ]);
//        
//        User::create([
//           'email'           =>      'piotr@t-media.pl',
//           'password'        =>      hash('sha512', 'userP')
//        ]);
//        
//        User::create([
//           'email'           =>      'marcin@t-media.pl',
//           'password'        =>      hash('sha512', 'userM')
//        ]);
//        
//        User::create([
//            'email'          =>      'jarek@t-media.pl',
//            'password'       =>      hash('sha512', 'userJ')
//        ]);
        
        
    }
    
}