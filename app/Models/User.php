<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use Notifiable, HasFactory;

    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'email',
        'password',
        'role',
        'profile_photo_url',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'user_courses')
                    ->withTimestamps();
    }

    /**
     * Relasi many-to-many antara User dan Course.
     */
    public function contents()
    {
        return $this->belongsToMany(CourseContent::class, 'user_course_contents')
                    ->withPivot('completed', 'progress')
                    ->withTimestamps();
    }

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Determine if the user has an admin role.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Relation to UserCourses (if applicable).
     */
    public function userCourses()
    {
        return $this->hasMany(UserCourse::class);
    }
}
