<?php

namespace Database\Factories;

use DateTime;
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
            'deadline' => $this->faker->unixTime(new DateTime('+3 weeks')),
            'done' => $this->faker->boolean(),
            'daily_list_id' => rand(1,1000),
        ];
    }
}
