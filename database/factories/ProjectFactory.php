<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'created_by' => fake()->numberBetween(1, 10),
            'name' => fake()->unique()->sentence(3),
            'slug' => fake()->unique()->slug(3),
            'description' => fake()->paragraph(5),
            'image' => fake()->imageUrl()
        ];
    }
}
