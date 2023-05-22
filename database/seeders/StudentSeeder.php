<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Course;
use App\Models\Region;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::factory()
            ->has(Course::factory()->count(3))
            ->has(Region::factory()->count(3))
            ->count(20)
            ->create();
    }
}