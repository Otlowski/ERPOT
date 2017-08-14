<?php

namespace App\Models\Questionnaires;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Questionnaires\QuestionnaireItem;

class QuestionnaireFeedback extends Model
{
    use SoftDeletes;
    
    /*
     * Atributes
     */
    
    protected $table = 'questionnaires_feedbacks';
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'users__object_id', 
        'questionnrires_items__id', 
        'username', 
        'value'
    ];
    
    protected $guarded = [
        'id'
    ];
    
    /*
     * Relations
     */
    
    public function questionnaireItem() {
        return $this->belongsTo(QuestionnaireItem::class, 'id');
    }
    
    /*
     * Helpers
     */
}