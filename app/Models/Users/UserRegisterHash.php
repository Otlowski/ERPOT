<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Users\User;
use App\Models\Users;
use Carbon\Carbon;

class UserRegisterHash extends Model
{
    use SoftDeletes;
    
    /*
     * Atributes
     */
    
    protected $table = 'users_register_hashes';
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'users__object_id', 
        'hash', 'start_at', 
        'finish_at'
    ];
    
    protected $guarded = [
        'id'
    ];
    
    /*
     * Relations
     */
    
    public function isActive() {
        if (!$this) {
            return false;
        }
        if (Carbon::now() > $this->finish_at) {
            $this->delete();
            return false;
        }
        return true;
    }
    
    public static function createRegisterHash($user) {
        $userRegisterHash = new UserRegisterHash();
        $now = Carbon::now();
        $userRegisterHash->start_at = $now;
        $userRegisterHash->finish_at = Carbon::now()->addMinutes(150); //+1 hour
        $userRegisterHash->hash = hash('sha512', 'REGISTER'.$now);
        $userRegisterHash->users__object_id = $user->object_id;
        $userRegisterHash->save();
        return $userRegisterHash;
    }
    
    public function user() {
        return $this->belongsTo(User::class, 'id');
    }
    
    /*
     * Helpers
     */
}
