<?php

namespace Database\Factories;

use App\Models\Folder;
use App\Models\User;
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
            'title' => $this->faker->name(),
            'description' => $this->faker->text(),
            'status' => $this->faker->randomElement(['todo', 'doing', 'done', 'missed']),
            'folder_id' => Folder::first() ?? Folder::factory(),
            'user_id' => User::first() ?? User::factory(),
        ];
    }
}
