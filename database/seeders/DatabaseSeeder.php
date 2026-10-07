<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'thaib@example.com'],
            [
                'name' => 'Nguyễn Quốc Thái',
                'password' => Hash::make('password'),
                'phone' => '0901234567',
                'dob' => '2002-09-28',
                'gender' => 'Nam',
                'address' => 'TP. Hồ Chí Minh',
                'role' => 'admin',
            ]
        );
        User::updateOrCreate(
            // 1. Điều kiện tìm kiếm (WHERE)
            ['email' => 'thai@gmail.com'],

            // 2. Dữ liệu cần tạo mới hoặc cập nhật
            [
                'name' => 'Nguyễn Quốc Thái',
                'password' => '123456', // Model User đã có 'password' => 'hashed'
                'phone' => '0901234567',
                'dob' => '2002-09-28',
                'gender' => 'Nam',
                'address' => 'TP. Hồ Chí Minh',
                'role' => 'user',
            ]
        );

        $this->call([
            ProductSeeder::class,
            BlogSeeder::class,
            ReviewSeeder::class,
        ]);
    }
}
