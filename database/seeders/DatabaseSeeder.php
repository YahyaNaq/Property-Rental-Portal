<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory(2)->create();
        $this->call(CategorySeeder::class);

        foreach($users as $user) {
            Property::factory(5)->create([
                'user_id' => $user->id
            ]);
        }
    }
}
