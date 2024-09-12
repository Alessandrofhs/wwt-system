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
        $admin = User::create([
            'email' => 'trialadmin@aiia.co.id',
            'name' => 'kole',
            'password' => bcrypt('12345678'),
        ]);
        $admin->assignRole('admin');
        $guest = User::create([
            'email' => 'trialuser@aiia.co.id',
            'name' => 'fabs',
            'password' => bcrypt('12345678'),
        ]);
        $guest->assignRole('guest');
    }
}
