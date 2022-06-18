<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(['name' => 'Mohamed Zayan', 'email' => 'zayanAdmin@gmail.com', 'password' => Hash::make('123456'), 'role' => config('roles.admin')]);
    }
}
