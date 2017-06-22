<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use \Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Users\User;

class UserSession extends Model
{
    use SoftDeletes;
    
    /*
     * Atributes
     */
    
    protected $table = 'users_sessions';
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'users__object_id', 
        'start_at', 
        'finish_at', 
        'hash'
    ];
    
    protected $guarded = [
        'id'
    ];
    
    /*
     * Relations
     */
    
    public static function user() {
        return $this->belongsTo(User::class, 'id');
    }
    
    /*
     * Helpers
     */
    
    public static function createUserSession($user) {
        $session = self::create([
            'start_at' => Carbon::now(),
            'finish_at' => Carbon::now()->addHour(),
            'users__object_id' => $user->object_id,
            'hash' => self::generateHash($user->email)
        ]);
        return $session;
    }
    
    public static function getSessionWithHash($hash) {
        return self::where('hash', '=', $hash)
                    ->where('start_at', '<=', Carbon::now() )
                    ->where('finish_at','>=', Carbon::now() )
                    ->first();
    }
    
    
    public static function generateHash($email) {
        return hash('sha512', $email.Carbon::now());
    }
    
    public static function refreshSession() {
        $parameters = Input::all();
        $hash = $parameters['hash'];
        $userSession = UserSession::where('hash', $hash);
        
        if (!$userSession) {
            return 'Session not found..';
        }
        
        if (Carbon::now()>= $userSession->start_at && Carbon::now()<= $userSession->finish_at) {
            $userSession->finish_at = Carbon::now()->addHour();
            $userSession->save();
            return $userSession;
        }
        
        return 'Session expired..';
    } 
}