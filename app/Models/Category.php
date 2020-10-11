<?php

namespace App\Models;


use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate'=> true,
            ]
        ];
    }
    use HasFactory;
    protected $fillable = ['name', 'photo_id'];
    public function posts(){

        return $this->hasMany(Post::class);
    }
    public function photo(){
        return $this->belongsTo(Photo::class);
    }
}
