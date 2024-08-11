<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserCourseContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_course_id',
        'content_id',
        'completed',
        'progress',
    ];

    public function userCourse()
    {
        return $this->belongsTo(UserCourse::class);
    }

    public function courseContent()
    {
        return $this->belongsTo(CourseContent::class);
    }

    public function content(): BelongsTo
    {
        return $this->belongsTo(CourseContent::class, 'content_id');
    }
}
