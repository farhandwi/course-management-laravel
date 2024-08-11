<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseContent extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'title', 'content', 'step_order'];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'user_course_contents')
                    ->withPivot('completed', 'progress')
                    ->withTimestamps();
    }


    public function userCourseContents()
    {
        return $this->hasMany(UserCourseContent::class);
    }

}
