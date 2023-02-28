<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Skill extends Model
{
    use HasFactory;
    use Sluggable;

    protected $guarded = [];

    /*protected $fillable = [
        'title',
        'short_title',
        'short_des',
        'long_des', 
        'skill_img',
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
