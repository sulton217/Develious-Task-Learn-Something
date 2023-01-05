<?php

namespace Database\Factories;

use App\Models\TodoList;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TodoList>
 */
class TodoListFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = TodoList::class;

    public function definition()
    {
        return [
            //
                'name' => $this->faker->sentence(2),
                'detail' => $this->faker->paragraph(10),
        ];
    }
}
