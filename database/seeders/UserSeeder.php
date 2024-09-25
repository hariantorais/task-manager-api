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
        User::create([
            'name' => 'Harianto',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Maryam',
            'email' => 'maryam@member.com',
            'password' => bcrypt('member'),
            'role' => 'member',
        ]);

        User::create([
            'name' => 'Asiyah',
            'email' => 'Asiyah@member.com',
            'password' => bcrypt('member'),
            'role' => 'member',
        ]);
    }
}
