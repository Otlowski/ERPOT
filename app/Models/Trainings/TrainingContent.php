<?php

namespace App\Models\Trainings;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Trainings\TrainingDocument;
use App\Models\Trainings\TrainingChapter;
use App\Models\Trainings\TrainingEvent;

class TrainingContent extends Model
{
    use SoftDeletes;
    
    /*
     * Atributes
     */
    
    protected $table = 'trainings_contents';
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'trainings_groups__id',
        'name', 
        'description'
    ];
    
    protected $guarded = [
        'id'
    ];
    
    /*
     * Relations
     */
      
     public function trainingGroup() {
        return $this->belongsTo(TrainingGroup::class, 'id', 'trainings_groups__id');
    }
    
    public function trainingDocument() {
        return $this->hasMany(TrainingDocument::class, 'trainings_contents__id', 'id');
    }
    
    public function trainingEvents() {
        return $this->belongsToMany(TrainingEvent::class,'training_events_contents');
    }
    
    public function trainingChapter() {
        return $this->hasMany(TrainingChapter::class, 'trainings_contents__id', 'id');
    }
    
}
