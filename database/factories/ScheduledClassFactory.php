<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ScheduledClass>
 */
class ScheduledClassFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'instructor_id' => rand(15, 24),
            'class_type_id' => rand(1, 4),
            'date_time' => Carbon::now()->addDays(rand(1, 10))->addMinutes(rand(0, 59))->addSeconds(rand(0, 59)),        ];
    }
}
