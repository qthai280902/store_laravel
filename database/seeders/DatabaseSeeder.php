<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::updateOrCreate(
            ['email' => 'thaib@example.com'],
            [
                'name' => 'Nguyễn Quốc Thái',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'phone' => '0901234567',
                'dob' => '2002-09-28',
                'gender' => 'Nam',
                'address' => 'TP. Hồ Chí Minh'
            ]
        );

        $this->call([
            ProductSeeder::class,
            BlogSeeder::class,
        ]);
    }
}
