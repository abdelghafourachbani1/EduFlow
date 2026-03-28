<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Interest;
use App\Models\Course;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $interests = Interest::factory()->count(10)->create();

        // 2. Create Teachers
        $teachers = User::factory()->count(5)->create([
            'role' => 'teacher'
        ]);

        // 3. Create Students
        $students = User::factory()->count(20)->create([
            'role' => 'student'
        ]);

        // 4. Attach interests to students
        foreach($students as $student){
            $student->interests()->attach(
                $interests->random(3)->pluck('id')
            );
        }

        // 5. Create Courses
        $courses = Course::factory()->count(15)->create();

        // 6. Attach interests to courses
        foreach($courses as $course){
            $course->interests()->attach(
                $interests->random(2)->pluck('id')
            );
        }
    }

}
