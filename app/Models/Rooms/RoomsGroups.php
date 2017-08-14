<?php

namespace App\Models\Rooms;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

class RoomsGroups extends Model
{
    use SoftDeletes;
    
    /*
     * Atributes
     */
    
    protected $table = 'rooms_groups';
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'name',  
        'description'
    ];
    
    protected $guarded = [
        'id'
    ];
    
    /*
     * Relations
     */
    
    public function rooms() {
        return $this->hasMany(Room::class, 'rooms_groups__id', 'id');
    }
    
}