<?php

namespace App\Models\Trainings;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Rooms\Room;
use App\Models\Trainings\TrainingContent;
use App\Models\Trainings\TrainingNote;
use App\Models\Trainings\TrainingUser;
use App\Models\Trainings\TrainingLeader;
use App\Models\Trainings\TrainingGroup;

class TrainingEvent extends Model
{
    use SoftDeletes;
    
    /*
     * Atributes
     */
    
    protected $table = 'trainings_events';
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
    
    private $prefix = 'TRXX';
    
    protected $fillable = [
        'name',
        'trainings_groups__id',
        'trainings_contents__id',
        'revision', 
        'rooms__object_id', 
        'object_id', 
        'seats_amount', 
        'seats_left', 
        'start_at', 
        'finish_at', 
        'status'
    ];
    
    protected $guarded = [
        'id', 'object_id'
    ];
        
    /*
     * Relations
     */
    
    public function room() {
        return $this->belongsTo(Room::class, 'id');
    }
    public function trainingGroup() {
        return $this->belongsTo(TrainingGroup::class, 'id', 'trainings_groups__id');
    }
    
    public function trainingContent() {
        return $this->belongsToMany(TrainingContent::class,'training_events_contents');
    }
    
    public function trainingNote() {
        return $this->hasMany(TrainingNote::class, 'trainings__object_id', 'object_id');
    }
    
    public function trainingUser() {
        return $this->belongsToMany(TrainingUser::class, 'training_events_users');
    }
    
    public function trainingLeader() {
        return $this->hasMany(TrainingLeader::class, 'trainings__object_id', 'object_id');
    }
    
    /*
     * Helpers
     */
    
    public function setObjectId () {
        $objectIdMask = '0000000000000000';
        $latestTraining = TrainingEvent::orderBy('object_id','DESC')->first();
        if( !isset($latestTraining->object_id) ) {
            $objectId = $this->prefix . substr($objectIdMask . (string)1,-16);
            return $objectId;
        }
        $latestObjectId = (int)substr($latestTraining->object_id,-16);
        $objectId = $this->prefix . substr($objectIdMask . (string)($latestObjectId + 1) ,-16);

        // eg: TRXX0000000000000153
        return $objectId;
    }
    
    public function incrementRevision() {
        $this->revision++;
    }
    
    public function checkSeatsAmount() {
        $this->seats_left = min($this->seats_amount, $this->seats_left);
    }
}
