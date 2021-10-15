<?php

namespace App\Models\Webinar;

use App\Models\Webinar\Webinar;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'id',
        'name',
        'webinar_id',
    ];

    public $timestamps = false;
    protected $table = 'webinartags';

    public function webinar()
    {
        return $this->belongsTo(Webinar::class);
    }
}
