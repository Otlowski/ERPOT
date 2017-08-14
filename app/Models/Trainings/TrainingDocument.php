<?php

namespace App\Models\Trainings;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Trainings\TrainingContent;

class TrainingDocument extends Model
{
    use SoftDeletes;
    
    /*
     * Atributes
     */
    
    protected $table = 'trainings_documents';
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'trainings_contents__id', 
        'name', 
        'description', 
        'source'
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
