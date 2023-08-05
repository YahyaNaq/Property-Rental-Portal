<?php

namespace Database\Seeders;

use App\Models\Agent;
use App\Models\City;
use App\Models\Country;
use App\Models\Location;
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
        $agents = Agent::factory(3)->create();
        User::factory(20)->create();
        
        $cities = City::factory(2)->create([
            'country_id' => Country::factory()->create()->id
        ]);
        
        foreach($cities as $city) {
            Location::factory(10)->create([
                'city_id' => $city->id
            ]);
        }

        $this->call([
            CategorySeeder::class,
            AdminSeeder::class,
        ]);

        foreach($agents as $agent) {
            Property::factory(5)->create([
                'agent_id' => $agent->id
            ]);
        }
    }
}
