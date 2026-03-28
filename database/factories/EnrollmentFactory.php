<?php

namespace Database\Factories;

use App\Models\Enrollment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Enrollment>
 */
class EnrollmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::where('role','student')->inRandomOrder()->first()?->id,
            'course_id' => \App\Models\Course::inRandomOrder()->first()?->id,
            'payment_status' => $this->faker->randomElement(['pending','paid'])
        ];
    }
}
