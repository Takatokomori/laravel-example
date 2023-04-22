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
    
    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class);
    }
}
