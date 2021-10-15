<?php

namespace App\Models\Webinar;

use Illuminate\Database\Eloquent\Model;
use App\Models\Webinar\Subchapter;

class Chapter extends Model
{

    protected $fillable = [
        'name',
        'section_id',
        'name',
        'tartib',
    ];


    protected $table = 'webinarchapters';
    protected $hidden = [];
    public $timestamps = false;

    public function subchapters()
    {
        return $this->hasMany(Subchapter::class);
    }
}
