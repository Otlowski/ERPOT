<?php

namespace App\Models\Questionnaires;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Questionnaires\QuestionnaireItem;
use App\Models\Questionnaires\QuestionnaireUser;
use App\Models\Trainings\TrainingContent;

class Questionnaire extends Model
{
    use SoftDeletes;
    
    /*
     * Atributes
     */
    
    protected $table = 'questionnaires';
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
    
    private $prefix = 'QUXX';
    
    protected $fillable = [
        'revision',
        'trainings_contents__id', 
        'name', 'description', 
        'status', 
        'source'
    ];
    
    protected $guarded = [
        'id', 
        'object_id'
    ];
    
    /*
     * Relations
     */
    
    public function questionnaireItem() {
        return $this->hasMany(QuestionnaireItem::class, 'questionnaires__object_id', 'object_id');
    }
    
    public function questionnaireUser() {
        return $this->hasMany(QuestionnaireUser::class, 'questionnaires__object_id', 'object_id');
    }
    
    public function trainingContent() {
        return $this->belongsTo(TrainingContent::class, 'id');
    }
    
    /*
     * Helpers
     */
    
    public function setObjectId () {
        $objectIdMask = '0000000000000000';
        $latestQuestionnaire = Questionnaire::orderBy('object_id','DESC')->first();
        if( !isset($latestQuestionnaire->object_id) ) {
            $objectId = $this->prefix . substr($objectIdMask . (string)1,-16);
            return $objectId;
        }
        $latestObjectId = (int)substr($latestQuestionnaire->object_id,-16);
        $objectId = $this->prefix . substr($objectIdMask . (string)($latestObjectId + 1) ,-16);

        // eg: QUXX0000000000000153
        return $objectId;
    }
    
    public function incrementRevision() {
        $this->revision++;
    }
}
