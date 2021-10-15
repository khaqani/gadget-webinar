<?php

namespace App\Models\Webinar;

use Illuminate\Database\Eloquent\Model;
use App\Models\Webinar\Webinar;
use App\Models\Base\User;

class Session extends Model
{

    protected $fillable = [
        'id',
        'webinar_id',
        'date',
        'start',
        'end',
        'title',
    ];

    protected $table = 'webinarsession';

    public $timestamps = false;

    public function getdateAttribute($date)
    {
        return \Morilog\Jalali\Jalalian::forge($date)->format('Y-m-d');
    }
    public function getstartAttribute($date)
    {
        return substr($date, 0, 5);
    }

    public function getendAttribute($date)
    {
        return substr($date, 0, 5);
    }

}
          