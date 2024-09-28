<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'System Admin',
            'email' => 'admin',
            'password' => bcrypt('123') // 123'ün encrypt edilmiş hali
        ]);

    }
}
