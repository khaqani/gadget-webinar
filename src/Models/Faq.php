<?php

namespace App\Models\Webinar;

use Illuminate\Database\Eloquent\Model;
use App\Models\Webinar\Webinar;
use App\Models\Base\User;

class Faq extends Model
{

    protected $fillable = [
        'id',
        'webinar_id',
        'question',
        'answer',
    ];
     	
    protected $table = 'webinarfaq';

    public $timestamps = false;
}
          