<?php

namespace App\Models\Trainings;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Trainings\Training;

class TrainingNote extends Model
{
    use SoftDeletes;
    
    /*
     * Atributes
     */
    protected $table = 'trainings_notes';
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'trainings_contents__id', 
        'note',
        'author'
    ];
    
    protected $guarded = [
        'id'
    ];
    
    /*
     * Relations
     */
    public function training() {
        return $this->belongsTo(Training::class, 'id');
    }
    
    /*
     * Helpers
     */
}
