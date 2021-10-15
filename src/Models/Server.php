<?php

namespace App\Models\Webinar;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $fillable = [
        'name',
        'url',
    ];


    protected $table = 'webinarservers';
    protected $hidden = [];
    public $timestamps = false;
}
