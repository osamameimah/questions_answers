<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

 class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo_path',
        // 'first_name',
        // 'last_name',
        // 'gender',
        // 'city',
        // 'country',
        //  'gender',
        // 'birthday',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'profile_photo_path'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'notification_options'=> 'json',
    ];

    protected $appends = [
'photo_url'
    ];

    public function questions(){
    return $this->hasMany(Question::class,'user_id','id');   
    }

    public function answers(){
        return $this->hasMany(Answer::class,'user_id','id');
    }
    public function profile(){
        return $this->hasOne(Profile::class,'user_id','id')->withDefault();
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    // public function preferredLocale()
    // {
    //     return 'ar';

    // }

    public function routeNotificationForVonage($notification)
    {
        return $this->mobile;
    }
public function getPhotoUrlAttribute(){
    if($this->profile_photo_path){
        return asset('storage/' . $this->profile_photo_path);
    }
    return 'https:://ui-avatars.com/api/?name=' .$this->name;
}

}
