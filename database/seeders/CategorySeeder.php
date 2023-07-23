<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Flat'],
            ['name' => 'House'],
            ['name' => 'Penthouse'],
            ['name' => 'Portion'],
        ];

        Category::insert($data);
    }
}
