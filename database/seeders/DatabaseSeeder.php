<?php

namespace Database\Seeders;

use App\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::insert([
        [
            'name'=>'Admin',
            'email'=>'Admin@gmail.com',
            'role'=>1,
            'created_at' => now(),
        ],
        [
            'name'=>'User',
            'email'=>'User@gmail.com',
            'role'=>0,
            'created_at' => now(),
        ]
        ]);

        Role::insert([
           [
            'name'=>'Administrator',
            'description'=>'super user',
            'role'=>1,
            'created_at' => now(),
           ],
           [
            'name'=>'roleUser',
            'description'=>'can add expenses',
            'role'=>0,
            'created_at' => now(),
           ]
        ]);
    }
}
