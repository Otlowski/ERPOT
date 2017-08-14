<?php

namespace App\Models\Rooms;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Trainings\Training;

class Room extends Model
{
    use SoftDeletes;
    
    /*
     * Atributes
     */
    
    protected $table = 'rooms';
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
    
    private $prefix = 'ROXX';
    
    protected $fillable = [
        'rooms_groups__id',
        'free_seats_amount', 
        'address1',
        'address2',
        'number',
        'description',
        'floor'
       
    ];
    
    protected $guarded = [
        'id'
    ];
    
    /*
     * Relations
     */
    
    public function training() {
        return $this->hasMany(Training::class, 'rooms__object_id', 'object_id');
    }
    public function roomGroup() {
        return $this->belongsTo(RoomsGroups::class, 'rooms_groups__id', 'id');
    }
    
    /*
     * Helpers
     */
    
    public function setObjectId () {
        $objectIdMask = '0000000000000000';
        $latestRoom = Room::orderBy('object_id','DESC')->first();
        if( !isset($latestRoom->object_id) ) {
            $objectId = $this->prefix . substr($objectIdMask . (string)1,-16);
            return $objectId;
        }
        $latestObjectId = (int)substr($latestRoom->object_id,-16);
        $objectId = $this->prefix . substr($objectIdMask . (string)($latestObjectId + 1) ,-16);

        // eg: ROXX0000000000000153
        return $objectId;
    }
    
    public function incrementRevision() {
        $this->revision++;
    }
}