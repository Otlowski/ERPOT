<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use App\Models\Users\UserSession;
use App\Models\Users\UserMail;
use App\Models\Users\UserRegisterHash;
use App\Models\Users\UserGroup;
use App\Models\Trainings\TrainingUser;
use App\Models\Trainings\TrainingLeader;
use App\Models\Questionnaires\QuestionnaireUser;

class User extends Model
{
    use SoftDeletes;
    
    /*
     * Atributes
     */
    
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
    
    private $prefix = 'USXX';
    
    protected $fillable = [
        'users_groups__id',
        'revision', 
        'username', 
        'email', 
        'password', 
        'firstname', 
        'lastname', 
        'name', 
        'status'
    ];

    protected $guarded = [
        'id', 
        'object_id'
    ];
    
    protected $hidden = [
        'password'
    ];
    
    /*
     * Relations
     */
    
    public function userSession() {
        return $this->hasMany(UserSession::class, 'users__object_id', 'object_id');
    }
    public function userMail() {
        return $this->hasMany(UserMail::class, 'users__object_id', 'object_id')
                    ->orderBy('created_at','DESC');
    }
    public function userGroup() {
        return $this->belongsTo(UserGroup::class, 'id', 'users_groups__id');
    }
    public function trainingUser() {
        return $this->hasMany(TrainingUser::class, 'users__object_id', 'object_id');
    }
    public function trainingLeader() {
        return $this->hasMany(TrainingLeader::class, 'users__object_id', 'object_id');
    }
    public function questionnaireUser() {
        return $this->hasMany(QuestionnaireUser::class, 'users__object_id', 'object_id');
    }
    public function userRegisterHash() {
        return $this->hasMany(UserRegisterHash::class, 'users__object_id', 'object_id');
    }
    
    public function userSessionActive() {
//        dd( Carbon::now() );
        return UserSession::where('users__object_id', $this->object_id)
                    ->where('start_at', '<=', Carbon::now() )
                    ->where('finish_at','>=', Carbon::now() )
                    ->first();
    }
    
    /*
     * Helpers
     */
    
    public function setObjectId () {
        $objectIdMask = '0000000000000000';
        $latestUser = User::orderBy('object_id','DESC')->first();
        if( !isset($latestUser->object_id) ) {
            $objectId = $this->prefix . substr($objectIdMask . (string)1,-16);
            return $objectId;
        }
        $latestObjectId = (int)substr($latestUser->object_id,-16);
        $objectId = $this->prefix . substr($objectIdMask . (string)($latestObjectId + 1) ,-16);

        // eg: USXX0000000000000153
        return $objectId;
    }
    
    public function incrementRevision() {
        $this->revision++;
    }
    
    public function isRegistred() {
        if ($this) {
            return true;
        }
        return false;
    }
    
    public function isActivated() {
        if ($this->status != 'activated') {
            return false;
        }
        return true;
    }
    
    public function linkNames() {
        $this->name = $this->firstname.' '.$this->lastname;
    }
    
    public function isCorrectPassword($password) {
        $passwordHashed = hash('sha512', $password);
        if ( $passwordHashed == $this->password ) {
            return true;
        }
        return false;
    }
}