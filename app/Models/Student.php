<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Course;

class Student extends Model
{
    use HasFactory;

    protected $table = "students";

    protected $fillable = [
        "name"
    ];
    
    // relationship with courses
    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class,
                                    "course_student")
                    ->withTimestamps();
    }

    // relationship with roles
    public function roles(): BelongToMany
    {
        return $this->belongsToMany(Role::class,
                            "region_student")
                    ->withPivot('is_admin')
                    ->withTimestamps();
    }
}
