<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'role' => 'admin',
            'admin_id' => 'ad1234',
            'name' => 'admin1234',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin1234'),
            'phone' => '08182537191'
        ]);
    }
}
