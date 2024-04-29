<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project_id' => fake()->numberBetween(1, 15),
            'created_by' => fake()->numberBetween(1, 10),
            'assigned_to' => fake()->numberBetween(1, 10),
            'name' => fake()->unique()->sentence(3),
            'slug' => fake()->unique()->slug(3),
            'description' => fake()->unique()->paragraph(5),
            'status_id' => fake()->numberBetween(1, 3),
            'start_date' => fake()->dateTimeThisYear(),
            'end_date' => fake()->dateTimeThisYear('+12 months')
        ];
    }
}
