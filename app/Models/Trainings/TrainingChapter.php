<?php

namespace App\Models\Trainings;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Trainings\TrainingChapter;

class TrainingChapter extends Model
{
    use SoftDeletes;
    
    /*
     * Atributes
     */
    
    protected $table = 'trainings_chapters';
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'trainings_contents__id', 
        'value'
    ];
    
    protected $guarded = [
        'id'
    ];
    
    /*
     * Relations
     */
    
    public function trainingContent() {
        return $this->belongsTo(TrainingContent::class, 'id');
    }
    
    /*
     * Helpers
     */
}
