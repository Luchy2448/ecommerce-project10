<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CmsPage>
 */
class CmsPageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'id' => fake()->unique()->numberBetween(4, 10),
            'title' => fake()->sentence(),
            'description' => fake()->slug(),
            'url' => fake()->url(),
            'meta_title' => fake()->sentence(),
            'meta_description' => fake()->sentence(),
            'meta_keyword' => fake()->sentence(),
            'status' => fake()->randomElement([0, 1]),
            'created_at' => now(),
        ];
    }
}
