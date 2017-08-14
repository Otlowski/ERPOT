<?php

namespace App\Models\Questionnaires;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Questionnaires\Questionnaire;
use App\Models\Questionnaires\QuestionnaireFeedback;

class QuestionnaireItem extends Model
{
    use SoftDeletes;
    
    /*
     * Atributes
     */
    
    protected $table = 'questionnaires_items';
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'questionnaires__object_id', 
        'value'
    ];
    
    protected $guarded = [
        'id'
    ];
    
    /*
     * Relations
     */
    
    public function questionnaire() {
        return $this->belongsTo(Questionnaire::class, 'id');
    }
    
    public function questionnaireFeedback() {
        return $this->hasMany(QuestionnaireFeedback::class, 'questionnaires_items__id', 'id');
    }
    
    /*
     * Helpers
     */
}
