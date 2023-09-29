<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Product::class;
    public function definition(): array
    {
        return [
            'Reference' => $this->faker->word,
            'Numserie' => $this->faker->unique()->randomNumber(6),
            'LibProd' => $this->faker->sentence,
            'NumFournisseur' => $this->faker->randomNumber(4),
            'Photo' => $this->faker->imageUrl(),
            'CodeBarre' => $this->faker->randomNumber(6),
            'PrixHT' => $this->faker->randomNumber(6),
            'PrixAchatHT' => $this->faker->randomNumber(6),
            'PPCTTC' => $this->faker->randomNumber(6),
            'PPHTTC' => $this->faker->randomNumber(6),
            'PGTTC' => $this->faker->randomNumber(6),
        ];
    }
}
