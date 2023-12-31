<?php

namespace Database\Factories;

use App\Models\Agent;
use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => null,
            'agent_id' => Agent::factory(),
            'category_id' => rand(1,4),
            'location_id' => rand(1,10),  
            'title' => $this->faker->text(70),
            'description' => $this->faker->text(1200),  
            'area' => $this->faker->numberBetween(80, 10000), 
            'monthly_rent' => ceil($this->faker->numberBetween(10000, 1000000000)/1000)*1000,  
            'bedrooms' => $this->faker->numberBetween(1,20),  
            'bathrooms' => $this->faker->numberBetween(1,10),  
        ];
    }
}
