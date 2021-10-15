<?php

namespace App\Models\Webinar;

use App\Models\Base\User;
use App\Models\Webinar\Webinar;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'id',
        'team_id',
        'reply_id',
        'text',
        'webinar_id',
        'user_id',
        'status'
    ];

    public $timestamps = true;
    protected $table = 'webinarcomments';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reply()
    {
        return $this->hasMany(static::class, 'reply_id');
    }

    public function webinar()
    {
        return $this->belongsTo(Webinar::class);
    }

    public function getCreatedAtAttribute($date)
    {
        return \Morilog\Jalali\Jalalian::forge($date)->format('Y-m-d H:i:s');
    }
}
