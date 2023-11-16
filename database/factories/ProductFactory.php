<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition(): array
    {

        return [
            'name' => $this->faker->word,
            'slug' => $this->faker->slug,
            'price' => $this->faker->numberBetween(100, 10000),
            'description' => $this->faker->sentence,
            'status' => $this->faker->numberBetween(1, 2),
            'file_uri' => $this->faker->url,
        ];
    }
}
