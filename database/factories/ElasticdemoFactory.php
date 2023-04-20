<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Elasticdemo>
 */
class ElasticdemoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'street' => $this->faker->streetAddress(),
            'number' => rand(999,4000),
            'code' => $this->faker->postcode(),
        ];
    }
}
