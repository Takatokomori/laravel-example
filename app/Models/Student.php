<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Course;
use App\Models\Region;

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

    // relationship with regions
    public function regions(): BelongsToMany
    {
        return $this->belongsToMany(Region::class, 'region_student')
            ->withTimestamps()
            ->withPivot(['is_admin', 'price'])
            ->withPivotValue('is_admin', false)
            ->withPivotValue('price', 0);
    }
}
