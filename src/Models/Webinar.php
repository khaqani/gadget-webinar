<?php

namespace Larabookir\Gateway\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Base\User;
use App\Models\Base\City;
use App\Models\Webinar\Organizer;
use App\Models\Webinar\Session;
use App\Models\Webinar\Teacher;
use App\Models\Webinar\Faq;
use App\Models\Webinar\Ticket;
use App\Models\Webinar\Category;
use App\Models\Webinar\Section;
use App\Models\Webinar\Participant;
use App\Models\Webinar\Comment;


class Webinar extends Model
{
    protected $fillable = [
        'id',
        'type',
        'server_id',
        'name',
        'slug',
        'description',
        'cover',
        'cost',
        'runtime',
        'tracking',
        'checkcomment',
        'creator_id',
        'status',
    ];

    

    protected $table = 'webinar';
    public $timestamps = true;

    public function getstartAttribute($date)
    {
        return \Morilog\Jalali\Jalalian::forge($date)->format('Y-m-d');
    }

    public function getendAttribute($date)
    {
        return \Morilog\Jalali\Jalalian::forge($date)->format('Y-m-d');
    }

    public function getdatetimeAttribute($date)
    {
        return \Morilog\Jalali\Jalalian::forge($date)->format('Y-m-d H:i:s');;
    }
    
    
    public function getTypeAttribute($value)
    {
        switch ($value) {
             case 1:
                return 'وبینار';
                break;
            default:
                return 'حضوری';
        }
    }

    public function getDstatusAttribute()
    {
        switch ($this->status) {
             case 0:
                return 'درحال بررسی';
                break;
            case 1:
                return 'تایید شده - در انتظار پرداخت';
                break;
    
            case 2:
                return 'تایید نهایی';
                break;
            case 3:
                return ' کنسل شده';
                break;
        
        }
    }

    public function participants()
    {
        return $this->belongsToMany(Participant::class, 'webinar_participant','webinar_id','user_id')->withTimestamps();
    }

    public function organizers()
    {
        return $this->belongsToMany(Organizer::class, 'webinar_oraganizer');
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class)->where('reply_id', null);
    }

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }


    public function sections()
    {
        return $this->hasMany(Section::class);
    }


    public function faqs()
    {
        return $this->hasMany(Faq::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }


    public function categories()
    {
        return $this->belongsToMany(Category::class, 'webinar_category');
    }



    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'webinar_teacher');
    }

    public function getDcoverAttribute()
    {
    if(is_null($this->cover))
        {
            return "/assets/images/avatar.png";
        }
    else {
            return "/uploads/". $this->cover;
        }
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function creator()
    {
        return $this->belongsTo(User::class , 'creator_id');
    }
}
