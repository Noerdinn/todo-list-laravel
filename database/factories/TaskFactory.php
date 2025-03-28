<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use function Symfony\Component\Clock\now;

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
            'user_id' => 1,
            'title' => fake()->sentence(4),
            'description' => fake()->text(),
            'deadline' => now(),
            'is_complete' => false,
            'priority' => 'high',

        ];
    }
}
