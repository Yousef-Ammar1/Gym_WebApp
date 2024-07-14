<?php

namespace Database\Seeders;

use App\Models\ClassType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassTypeSedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClassType::create([
            'name' => 'Yoga',
            'description' => fake()->text(),
            'minutes' => 60,
        ]);
        ClassType::create([
            'name' => 'Sex',
            'description' => fake()->text(),
            'minutes' => 50,
        ]);
        ClassType::create([
            'name' => 'Tree',
            'description' => fake()->text(),
            'minutes' => 20,
        ]);
        ClassType::create([
            'name' => 'Free',
            'description' => fake()->text(),
            'minutes' => 10,
        ]);
    }
}
