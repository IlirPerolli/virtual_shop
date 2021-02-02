<?php

namespace App\Models;
use Cviebrock\EloquentSluggable\Sluggable; //Per pretty url
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use Sluggable;
    use SluggableScopeHelpers;
    public function sluggable()
    {
        return [
            'slug' => [

            ]
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','surname','business_name','gender','is_business','username','bio', 'email', 'password','photo_id','slug'
    ];

    public function photo(){
        return $this->belongsTo(Photo::class);
    }
    public function posts(){
        return $this->hasMany(Post::class);
    }
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'leader_id', 'follower_id')->withTimestamps()->withPivot('follower_id', 'leader_id');
    }
    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'leader_id')->withTimestamps()->withPivot('follower_id', 'leader_id');
    }
    public function likes()
    {
        return $this->belongsToMany(Post::class, 'likes', 'user_id', 'post_id')->withTimestamps()->withPivot('user_id', 'post_id');
    }
    public function role(){
        return $this->belongsTo(Role::class);
    }
    public function isAdmin(){
        if ($this->role->name == "administrator"){
            return true;
        }
        return false;
    }
    public function setNameAttribute($value){
        $name = $value;
        $name = strtolower($name);
        $name = ucfirst($name);
        $this->attributes['name'] = $name;
    }
    public function setSurnameAttribute($value){
        $surname = $value;
        $surname = strtolower($surname);
        $surname = ucfirst($surname);
        $this->attributes['surname'] = $surname;
    }
    public function setUsernameAttribute($value){
        $username = strtolower($value);
        $this->attributes['username'] = $username;
    }
    public function setSlugAttribute($value){
        $slug = strtolower($value);
        $this->attributes['slug'] = $slug;
    }
    public function setEmailAttribute($value){
        $email = strtolower($value);
        $this->attributes['email'] = $email;
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
