<?php

namespace App\Models\Trainings;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Trainings\Training;
use App\Models\Users\User;

class TrainingLeader extends Model
{
    use SoftDeletes;
    
    /*
     * Atributes
     */
    
    protected $table = 'trainings_leaders';
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'users__object_id', 
        'trainings__object_id'
    ];
    
    protected $guarded = [
        'id'
    ];
    
    /*
     * Relations
     */
    
    public function training() {
        return $this->belongsToMany(Training::class, 'id');
    }
    
    public function user() {
        return $this->belongsTo(User::class, 'id');
    }
    
    /*
     * Helpers
     */
}
