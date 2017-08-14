<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Users\User;

class UserMail extends Model
{
    use SoftDeletes;
    
    /*
     * Atributes
     */
    
    protected $table = 'users_mails';
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'users__object_id', 
        'send_date', 
        'subject', 
        'message'
    ];
    
    protected $guarded = [
        'id'
    ];
    
    /*
     * Relations
     */
    
    public function user() {
        return $this->belongsTo(User::class, 'id');//, 'users__object_id');
        //return $this->belongsTo(User::class, 'users__object_id', 'object_id');
    }
    
    /*
     * Helpers
     */
}
