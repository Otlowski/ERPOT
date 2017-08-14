<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Users\User;


class UserGroup extends Model
{
    use SoftDeletes;
    
    /*
     * Atributes
     */
    
    protected $table = 'users_groups';
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
    
    
    protected $fillable = [
        'name', 
        'description', 
    ];

    protected $guarded = [
        'id', 
    ];
    
    /*
     * Relations
     */
    
    public function users() {
        return $this->hasMany(User::class, 'users_groups__id', 'id');
    }
    
}