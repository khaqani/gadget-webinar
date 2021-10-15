<?php

namespace App\Models\Webinar;

use Illuminate\Database\Eloquent\Model;
use App\Models\Webinar\Webinar;

class Category extends Model
{

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'cover',
        'status',
    ];

    protected $table = 'webinarcategories';
    protected $hidden = [];

    public function webinars()
    {
        return $this->belongsToMany(Webinar::class , 'webinar_category');
    }

    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(static::class, 'parent_id');
    }
}
