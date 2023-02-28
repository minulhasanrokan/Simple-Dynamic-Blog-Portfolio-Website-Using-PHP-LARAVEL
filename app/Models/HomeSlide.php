<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class HomeSlide extends Model
{
    use HasFactory;
    use Sluggable;

    protected $guarded = [];

    /*protected $fillable = [
        'title',
        'short_des',
        'long_des',
        'slide_img',
        'video_url',
        'slug',
    ];*/

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }
}
 