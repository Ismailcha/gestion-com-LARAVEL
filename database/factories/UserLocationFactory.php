<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserLocation>
 */
class UserLocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = UserLocation::class;
    public function definition(): array
    {
        $user = User::where('role', 0)->first();
        return [
            'user_id' => 11, // Assuming user IDs range from 1 to 100
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
        ];
    }
}
