<?php

namespace Database\Factories;

use App\Models\ToDoList;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ToDoListFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = ToDoList::class;

    public function definition(): array
    {
        return [
            'case' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'is_completed' => $this->faker->numberBetween(0,1)
        ];
    }
}
