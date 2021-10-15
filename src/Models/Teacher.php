<?php

namespace App\Models\Webinar;

use Illuminate\Database\Eloquent\Model;
use App\Models\Webinar;
use App\Models\Base\User;

class Teacher extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'slogen',
        'avatar',
        'tel',
    ];

    protected $table = 'webinarteacher';

    public $timestamps = false;

    public function getCreatedAtAttribute($date)
    {
        return \Morilog\Jalali\Jalalian::forge($date)->format('Y-m-d H:i:s');
    }
    public function webinar()
    {
        return $this->belongsToMany(Webinar::class, 'webinar_teacher');
    }
    public function getDavatarAttribute()
    {
    if(is_null($this->avatar))
        {
            return "/assets/images/avatar.png";
        }
    else {
            return "/uploads/". $this->avatar;
        }
    }

}
          