<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'division_id', 
        'title', 
        'description', 
        'photo',       
        'step_order'
    ];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function contents()
    {
        return $this->hasMany(CourseContent::class);
    }

    public function userCourses()
    {
        return $this->hasMany(UserCourse::class);
    }
    
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_courses')
                    ->withTimestamps();
    }
    /**
     * Mendapatkan nama lengkap pengguna.
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Mengecek apakah pengguna memiliki peran admin.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}

