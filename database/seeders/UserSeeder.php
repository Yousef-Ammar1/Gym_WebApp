<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Yousef',
            'email' => 'yousef@gmail.com',
            'role' =>'member',
        ]);
        User::factory()->create([
            'name' => 'John',
            'email' => 'john@gmail.com',
            'role' => 'instructor',
        ]);
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
        ]);


        User::factory()->count(10)->create();
        User::factory()->count(10)->create([
            'role' => 'instructor',
        ]);
    }
}
