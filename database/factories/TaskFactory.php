<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'description' => $this->faker->text,
            'deadline'  => $this->faker->dateTime(),
            'done' => $this->faker->boolean(),
            'daily_list_id' => rand(1,500),
        ];
    }
}
