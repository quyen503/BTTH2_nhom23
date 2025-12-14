<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'lesson_id',
        'filename',
        'file_path',
        'file_type'
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
