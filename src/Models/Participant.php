<?php

namespace App\Models\Webinar;

use Illuminate\Database\Eloquent\Model;
use App\Models\Webinar;
use App\Models\Base\User;


class Participant extends Model
{

    protected $fillable = [
        'webinar_id',
        'user_id',
        'created_at',
    ];

    protected $table = 'webinar_participant';

    public $timestamps = false;

    public function getCreatedAtAttribute($date)
    {
        return \Morilog\Jalali\Jalalian::forge($date)->format('Y-m-d H:i:s');
    }
    public function webinar()
    {
        return $this->belongsTo(Webinar::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }

}
          