<?php

namespace App\Models\Webinar;

use Illuminate\Database\Eloquent\Model;
use App\Models\Webinar\Chapter;

class Section extends Model
{

    protected $fillable = [
        'name',
        'webinar_id',
        'name',
        'tartib',
    ];


    protected $table = 'webinarsections';
    protected $hidden = [];
    public $timestamps = false;

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

}
