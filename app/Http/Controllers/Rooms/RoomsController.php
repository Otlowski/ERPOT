<?php

namespace App\Http\Controllers\Rooms;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Rooms\Room;
use App\Models\Trainings\Training;

class RoomsController extends Controller {

    public $moduleParams = [
        'moduleId' => null,
        'moduleCode' => null
    ];

    public function showRoomsIndex() {

        return view('Rooms.index');
    }

    public function listRooms(Request $request) {

        try {

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                        'rooms_groups__id' => 'exists:rooms_groups,id',
                        'with_trainings' => 'boolean',
                        'object_ids' => 'array',
                        'object_ids.*.object_id' => 'string'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }

            $query = Room::whereNull('deleted_at');

            if (isset($parameters['rooms_groups__id']) && $parameters['rooms_groups__id']) {
                $query->where('rooms_groups__id', '=', $parameters['rooms_groups__id']);
            }

            if (isset($parameters['with_trainings']) && $parameters['with_trainings']) {
                $query->with('training');
            }

            if (isset($parameters['object_ids'])) {
                $query->whereIn('object_id', $parameters['object_ids']);
            }

            $rooms = $query->orderBy('number','DESC')->get();

            if (!$rooms) {
                return self::responseJson('Table "rooms" is empty', 'error');
            }

            $response = $rooms;

            return self::responseJson($response);
        } catch (Exception $ex) {
            return self::responseJson($ex->getMessage(), 'error');
        }
    }

    public function addRoom(Request $request) {

        try {

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                        'create' => 'required|array',
                        'create.*.rooms_groups__id' => 'integer',
                        'create.*.number' => 'required|integer',
                        'create.*.floor' => 'integer',
                        'create.*.free_seats_amount' => 'integer',
                        'create.*.address1' => 'string',
                        'create.*.address2' => 'string',
                        'create.*.description' => 'string'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error', 'error');
            }
            $created = [];
            \DB::beginTransaction();
            foreach ($parameters['create'] as $index => $param) {
                $room = new Room($param);
                $room->object_id = $room->setObjectId();
                $room->save();
                $created[] = $room;
            }
            \DB::commit();

            $response = [
                'created' => $created,
                'deleted' => []
            ];

            return self::responseJson($response);
        } catch (Exception $ex) {
            \DB::rollback();
            return self::responseJson($ex->getMessage(), 'error');
        }
    }

    public function updateRoom(Request $request) {

        try {

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                        'create' => 'required|array',
                        'create.*.object_id' => 'required|string|exists:rooms',
//                        'create.*.rooms_groups__id' => 'exists:rooms_groups,id',
                        'create.*.free_seats_amount' => 'integer',
                        'create.*.address1' => 'string',
                        'create.*.address2' => 'string',
                        'create.*.floor' => 'integer',
                        'create.*.description' => 'string',
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error','error');
            }

            $created = [];
            $deleted = [];
            \DB::beginTransaction();
            foreach ($parameters['create'] as $index => $param) {
                $room = Room::where('object_id', $param['object_id'])->orderBy('revision', 'desc')->first();
//                if (!$room) {
//                    self::responseJson($index.' element is incorrect..', 'error');
//                }
                $deleted[] = $room;
                $newRoom = new Room($param);
                $newRoom->object_id = $room->object_id;
                $newRoom->rooms_groups__id = $room->rooms_groups__id;
                $newRoom->created_at = $room->created_at;
                $newRoom->number = $room->number;
                $newRoom->incrementRevision();
                $newRoom->save();
                $room->delete();
                $created[] = $newRoom;
            }
            \DB::commit();

            $response = [
                'created' => $created,
                'deleted' => []
            ];

            return self::responseJson($response);
        } catch (Exception $ex) {
            \DB::rollback();
            return self::responseJson($ex->getMessage(), 'error');
        }
    }

    public function deleteRoom(Request $request) {

        try {

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                        'delete' => 'required|array',
                        'delete.*.object_id' => 'required|string|exists:rooms'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error','error');
            }

            $deleted = [];
            \DB::beginTransaction();
            foreach ($parameters['delete'] as $index => $param) {
                $room = Room::where('object_id', $param['object_id'])->orderBy('revision', 'desc')->first();
//                if (!$room) {
//                    self::responseJson($index.' element is incorrect..', 'error');
//                }
                $deleted[] = $room;
                $room->delete();
            }
            \DB::commit();

            $response = [
                'created' => [],
                'deleted' => $deleted
            ];

            return self::responseJson($response);
        } catch (Exception $ex) {
            \DB::rollback();
            return self::responseJson($ex->getMessage(), 'error');
        }
    }

    public function detailsRoom(Request $request) {

        try {

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                        'object_id' => 'exists:rooms,object_id',
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error', 'error');
            }

            if(isset($parameters['object_id']) && ($parameters['object_id'])) {
                $room = Room::where('object_id', '=', $parameters['object_id']) 
                        ->with('roomGroup')
                        ->get();
            }

            if (empty($room)) {
                return self::responseJson('Room does not exist', 'error', null);
            }


            return self::responseJson($room);
        } catch (\Exception $ex) {
            return self::responseJson($ex->getMessage(), 'error', null);
        }
    }

}
