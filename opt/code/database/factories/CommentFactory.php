<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 100),
            'invitation_id' => $this->faker->numberBetween(1, 100),
            'favorite_num' => $this->faker->numberBetween(1, 100),
            'content' => $this->faker->text(),
        ];
    }
}
