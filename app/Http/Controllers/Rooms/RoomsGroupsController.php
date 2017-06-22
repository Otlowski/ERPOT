<?php

namespace App\Http\Controllers\Rooms;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Rooms\RoomsGroups;

class RoomsGroupsController extends Controller {

    public $moduleParams = [
        'moduleId' => null,
        'moduleCode' => null
    ];

    public function listRoomsGroups(Request $request) {

        try {

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                        'with_rooms' => 'boolean',
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }

            $query = RoomsGroups::whereNull('deleted_at');

            if (isset($parameters['with_rooms']) && $parameters['with_rooms']) {
                $query->with('rooms');
            }

            $roomsGroups = $query->get();

            if (!$roomsGroups) {
                return self::responseJson('Table "rooms_groups" is empty', 'error');
            }

            $response = $roomsGroups;

            return self::responseJson($response);
        } catch (Exception $ex) {
            return self::responseJson($ex->getMessage(), 'error');
        }
    }
    
    public function addRoomsGroups(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'create'                           =>   'required|array',
                'create.*.name'                    =>   'required|string',
                'create.*.description'             =>   'required|string',
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error','error');
            }
            
            $created = [];
            \DB::beginTransaction();
            foreach($parameters['create'] as $index => $param) {
                $roomGroup = new RoomsGroups($param);
                $roomGroup->save();
                $created[$index] = $roomGroup;
            }
            \DB::commit();
            
            $response = [
                'created'   =>  $created,
                'deleted'   =>  []
            ];
            
            return self::responseJson($response);
            
        } catch (Exception $ex) {
            \DB::rollback();
            return self::responseJson($ex->getMessage(), 'error');
        }
    }
    
    public function updateRoomsGroups(Request $request) {
        
        try {    

            $parameters = $request->all();
            
            $validator = Validator::make($request->all(), [
                'create'                            =>   'required|array',
                'create.*.id'                       =>   'required|exists:rooms_groups,id',
                'create.*.name'                     =>   'required|string',
                'create.*.description'              =>   'string',
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error', 'error');
            }
            
            $created = [];
            $deleted = [];
            \DB::beginTransaction();
            foreach($parameters['create'] as $index => $param) {
                
                $roomGroup = RoomsGroups::where('id', $param['id'])->first();
                
                $deletedGroup = new RoomsGroups();
                $deletedGroup->id = $roomGroup->id;
                $deletedGroup->description = $roomGroup->description;
                $deletedGroup->name = $roomGroup->name;
                
                $newRoomGroup =  $roomGroup;
                $newRoomGroup->update($param);
                $deleted[]= $deletedGroup;
                $created[] = $newRoomGroup;
            }
            \DB::commit();
            
            $response = [
                'created'   =>  $created,
                'deleted'   =>  $deleted
            ];
            
            return self::responseJson($response);
            
        } catch (Exception $ex) {
            \DB::rollback();
            return self::responseJson($ex->getMessage(), 'error');
        }
    }
    
    public function deleteRoomsGroups(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'delete'         =>    'required|array',
                'delete.*.id'    =>    'required|integer|exists:rooms_groups,id'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error','error');
            }

            $deleted = [];
            \DB::beginTransaction();
            foreach($parameters['delete'] as $index => $param) {
                $RoomsGroups = RoomsGroups::where('id', $param['id'])->first();
//                if (!$RoomsGroups) {
//                    self::responseJson('Room group not found', 'error', '0021');
//                }
                $rooms = $RoomsGroups->rooms;
                if(count($rooms) > 0){
                    return self::responseJson('Cannot delete , Group  has containing rooms', 'error', '-0051');
                }
                $deleted[] = $RoomsGroups;
                $RoomsGroups->delete();
            }
            \DB::commit();

            $response = [
                'created'   =>  [],
                'deleted'   =>  $deleted
            ];
            
            return self::responseJson($response);
            
        } catch (Exception $ex) {
            \DB::rollback();
            return self::responseJson($ex->getMessage(), 'error');
        }
    }
    public function detailsRoomsGroups(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                    'id'     =>    'required|integer|exists:rooms_groups,id'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }

            if(isset($parameters['id']) && ($parameters['id'])) {
                $RoomsGroups = RoomsGroups::where('id', '=', $parameters['id'])->first();
            }

            if (empty($RoomsGroups)) {
                return self::responseJson('User Group does not exist', 'error', null);
            }


            return self::responseJson($RoomsGroups);
        } catch (\Exception $ex) {
            return self::responseJson($ex->getMessage(), 'error', null);
        }
    }

}
