<?php

namespace Database\Seeders;

use App\Models\Agent;
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
        User::factory(20)->create();
        $agents = Agent::factory(3)->create();

        $this->call(CategorySeeder::class);
        
        $this->call(AdminSeeder::class);

        foreach($agents as $agent) {
            Property::factory(5)->create([
                'agent_id' => $agent->id
            ]);
        }
    }
}
