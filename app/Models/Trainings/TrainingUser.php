<?php

namespace App\Models\Trainings;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Trainings\TrainingEvent;
use App\Models\Users\User;
use App\Models\Questionnaires\QuestionnaireUser;

class TrainingUser extends Model
{
    use SoftDeletes;
    
    /*
     * Atributes
     */
    
    protected $table = 'trainings_users';
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'users__object_id', 
        'trainings__object_id',
        'presence_confirmation'
    ];
    
    protected $guarded = [
        'id'
    ];
    
    /*
     * Relations
     */
    
    public function trainingEvents() {
        return $this->belongsToMany(TrainingEvent::class, 'training_events_contents');
    }
    
    public function user() {
        return $this->belongsTo(User::class, 'id');
    }
    
    public function questionnaireUser() {
        return $this->hasOne(QuestionnaireUser::class, 'trainings_users__id', 'id');
    }
    
    /*
     * Helpers
     */
}
