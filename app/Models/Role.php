<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable=[
        'name','abilities'
    ];
// هذا الحقل بحول صيغته في الذاتا بيز لشكل اراي
    protected $casts=['abilities'=>'array'];

    public function users(){
        return $this->belongsToMany(User::class,'role_user'); 
    }
}
