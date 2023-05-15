<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class Regions extends Model
{
    use HasFactory;

    protected $table = "regions";
    protected $fillable = [
        "name"
    ];

    // relationship with students
    public function students(): BelongToMany
    {
        return $this->belongsToMany(Student::class,
                        "region_student")
                    ->withPivot('is_admin')
                    ->withTimestamps();
    }
}
