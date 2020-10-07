<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $uploads = '/images/';
    protected $fillable = ['photo'];
    public function getPhotoAttribute($value){
        if (strpos($value,',') === false){
            return $this->uploads.$value;
        }
        else {
            return $value;
        }

    }
}
