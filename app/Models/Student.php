<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    protected $fillable = [
        'image', 'status', 'user_id', 'class_id', 'course_id'
    ];
    
    public function user(){
    	return $this->belongsTo(User::class, 'user_id');
    }
    public function attendanceDetail(){
        return $this->hasOne(AttendanceDetail::class, 'student_id', 'id');
    }

    public function course(){
    	return $this->belongsTo(Course::class, 'course_id');
    }
}
