<?php

namespace App\Models\Trainings;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Trainings\TrainingEvent;
use App\Models\Trainings\TrainingUser;


class TrainingEventUser extends Model {

    use SoftDeletes;

    /*
     * Atributes
     */

    protected $table = 'trainings_events_users';
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'trainings_events__id',
        'trainings_users__id',
    ];
    protected $guarded = [
        'id',
    ];

    /*
     * Relations
     */


}
