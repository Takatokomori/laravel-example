<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Region extends Model
{
    use HasFactory;

    protected $table = "regions";
    protected $fillable = [
        "name"
    ];

    // relationship with students
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class,
                        "region_student")
                    ->withTimestamps()
                    ->withPivot(['is_admin'])
                    ->withPivotValue('is_admin', false);
    }
}
