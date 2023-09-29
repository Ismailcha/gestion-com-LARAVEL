<?php

namespace Database\Factories;

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Client;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Clien>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Client::class;
    public function definition(): array
    {
        return [
            'Pharmacie' => $this->faker->company,
            'CodePostal' => $this->faker->numberBetween(100, 100000),
            'NomClient' => $this->faker->lastName,
            'Prénom' => $this->faker->firstName,
            'Adresse' => $this->faker->address,
            'Ville' => $this->faker->city,
            'Pays' => $this->faker->country,
            'Telephone' => $this->faker->numberBetween(100, 100000),
            'Fax' => $this->faker->numberBetween(100, 100000),
            'EMail' => $this->faker->email,
            'Type' => $this->faker->randomElement(['Type 1', 'Type 2', 'Type 3']),
            'Observations' => $this->faker->sentence,
            'Plan' => $this->faker->randomElement(['Plan A', 'Plan B', 'Plan C']),
        ];
    }
}
