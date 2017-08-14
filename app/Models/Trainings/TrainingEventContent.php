<?php

namespace App\Models\Trainings;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Trainings\TrainingEvent;
use App\Models\Trainings\TrainingContent;


class TrainingEventContent extends Model {

    use SoftDeletes;

    /*
     * Atributes
     */
    
    protected $table = 'trainings_events_contents';
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'trainings_events__id',
        'trainings_contents__id',
    ];
    protected $guarded = [
        'id',
    ];

    /*
     * Relations
     */


}
