<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'username',
        'email',
        'password',
        'fullname',
        'role'
    ];

    protected $hidden = [
        'password',
    ];

    // 1 giảng viên có nhiều khóa học
    public function courses()
    {
        return $this->hasMany(Course::class, 'instructor_id');
    }

    // 1 học viên đăng ký nhiều khóa học
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'student_id');
    }
}
