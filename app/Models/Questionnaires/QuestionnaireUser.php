<?php

namespace App\Models\Questionnaires;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Questionnaires\Questionnaire;
use App\Models\Users\User;
use App\Models\Trainings\TrainingUser;

class QuestionnaireUser extends Model
{
    use SoftDeletes;
    
    /*
     * Atributes
     */
    
    protected $table = 'questionnaires_users';
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'questionnaires__object_id', 
        'users__object_id', 
        'trainings_users__id', 
        'status'
    ];
    
    protected $guarded = [
        'id'
    ];
    
    /*
     * Relations
     */
    public function questionnaire() {
        return $this->belongsToMany(Questionnaire::class, 'id');
    }
    
    public function user() {
        return $this->belongsToMany(User::class, 'id');
    }
    
    public function trainingUser() {
        return $this->belongsTo(TrainingUser::class, 'id');
    }
    
    /*
     * Helpers
     */
}
