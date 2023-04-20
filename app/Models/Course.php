<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Student;

class Course extends Model
{
    use HasFactory;

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Students::class);
    }
}
