<?php

namespace App\Models\Webinar;

use Illuminate\Database\Eloquent\Model;
use App\Models\Webinar;
use App\Models\Base\User;


class Ticket extends Model
{

    protected $fillable = [
        'webinar_id',
        'title',
        'start',
        'end',
        'count',
        'isvideo',
        'price',
    ];

    protected $table = 'webinartickets';

    public $timestamps = false;

    public function getCreatedAtAttribute($date)
    {
        return \Morilog\Jalali\Jalalian::forge($date)->format('Y-m-d H:i:s');
    }
    public function webinar()
    {
        return $this->belongsToMany(Webinar::class);
    }

}
          