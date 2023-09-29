<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Commercials>
 */
class CommercialsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nomDel' => $this->faker->name(),
            'CIN' => $this->faker->randomNumber(1, 10),
            'CNSSDel' => $this->faker->randomNumber(1, 10),
            'AdresseDel' => $this->faker->address(),
            'NumCaGrise' => $this->faker->randomNumber(1, 10),
            'NumPC' => $this->faker->randomNumber(1, 10),
            'Poste' => $this->faker->jobTitle(),
            'DateEmb' => $this->faker->dateTime(),
            'Qualié' => $this->faker->randomElement(['A', 'B', 'C']),
            'Affecaions' => $this->faker->sentence(),
            'user_id' => User::factory()->create()->id,
        ];
    }
}
