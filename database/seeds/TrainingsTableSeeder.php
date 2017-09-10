<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Trainings\Training;
use App\Models\Trainings\TrainingContent;
use App\Models\Rooms\Room;

class TrainingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private static $statuses = [
        'finished',
        'not finished',
        'cancelled'
    ];

    public function run()
    {
        // \DB::table('trainings')->delete();

        $faker = \Faker\Factory::create();

        $rooms = Room::all()->toArray();

        $trainingsContents = TrainingContent::all()->toArray();

        $limit = rand(100, 200);

        for ($i = 0; $i < $limit; $i++) {

            $seats_amount = $faker->numberBetween(2, 10) * 5;

            $start_at = Carbon::create(2016, $faker->month, $faker->dayOfMonth, 0, 0, 0);
            $start_at->addHours($faker->numberBetween(8, 16));
            $start_at->addMinutes($faker->numberBetween(0, 4) * 15);

            $status = 'not finished';
            if ($start_at->isPast()) {
                $status = 'finished';
            }

            if ($faker->boolean(5)) {
                $status = 'cancelled';
            }

            $roomIndex = array_rand($rooms);
            $roomObjectId = $rooms[$roomIndex]['object_id'];

            $trainingContentIndex = array_rand($trainingsContents);
            $trainingContentId = $trainingsContents[$trainingContentIndex]['id'];

            $parameters = [
                'rooms__object_id'                   =>      $roomObjectId,
                'trainings_contents__id'             =>      $trainingContentId,
                'seats_amount'                       =>      $seats_amount,
                'seats_left'                         =>      $faker->numberBetween(30, $seats_amount),
                'start_at'                           =>      $start_at,
                'finish_at'                          =>      $start_at->copy()->addHours($faker->numberBetween(2, 4)),
                'status'                             =>      $status
                //self::$statuses[array_rand(TrainingsTableSeeder::$statuses)]
            ];

            $training = new Training($parameters);
            $training->object_id = $training->setObjectId();
            $training->save();
        }
    }
}
