<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Commercials;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\visite>
 */
class visiteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $clientIds = Client::pluck('NumClient')->all();
        $commercialIds = Commercials::pluck('IDDelegue')->all();

        return [
            'Identifiant' => $this->faker->randomNumber(),
            'Date' => $this->faker->dateTime(),
            'Duree' => $this->faker->randomNumber(1, 10),
            'Observation' => $this->faker->sentence(),
            'Latitude' => $this->faker->latitude(),
            'Longitude' => $this->faker->longitude(),
            'NumClient' => $this->faker->randomElement($clientIds),
            'commercial_id' => $this->faker->randomElement($commercialIds),
        ];
    }
}
