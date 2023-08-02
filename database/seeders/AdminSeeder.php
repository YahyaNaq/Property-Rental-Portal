<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::insert([
            'full_name' => 'Yahya Naqvi',
            'username' => 'yahyan',
            'email' => 'yahya@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt(12345678), // password
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
