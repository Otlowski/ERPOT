<?php

namespace App\Models\Trainings;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Trainings\Training;
use App\Models\Trainings\TrainingContent;

class TrainingGroup extends Model
{
    use SoftDeletes;
    
    /*
     * Atributes
     */
    
    protected $table = 'trainings_groups';
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
    
    
    protected $fillable = [
        'name', 
        'description', 
    ];

    protected $guarded = [
        'id', 
    ];
    
    /*
     * Relations
     */
    
    public function trainings() {
        return $this->hasMany(TrainingEvent::class, 'trainings_groups__id', 'id');
    }
    public function trainingsContents() {
        return $this->hasMany(TrainingContent::class, 'trainings_groups__id', 'id');
    }
}