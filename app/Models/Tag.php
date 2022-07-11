<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    use HasFactory;
    const CREATED_AT = 'created_at';
    const UPDATED_at = 'updated_at';
    protected $table = "tags";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $timestamps = true;


    public function question()
    {
        return $this->belongsToMany(
            question::class,
            'question_answer',
            'tag_id',
            'question_id',
            'id',
            'id'

        );
    }
}
