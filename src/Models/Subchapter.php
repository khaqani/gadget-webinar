<?php

namespace App\Models\Webinar;

use Illuminate\Database\Eloquent\Model;

class Subchapter extends Model
{

    protected $fillable = [
        'name',
        'chapter_id',
        'name',
        'tartib',
    ];


    protected $table = 'webinarsubchapters';
    protected $hidden = [];
    public $timestamps = false;


}
