<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReplesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userid = $this->faker->numberBetween(1, 100);

        return [
            'user_id' => $userid,
            'target_user_id' => $this->faker->numberBetween(1, 100),
            'invitation_id' => $this->faker->numberBetween(1, 100),
            'comment_id' => $this->faker->numberBetween(1, 100),
            'favorite_num' => $this->faker->numberBetween(1, 100),
            'content' => $this->faker->text(),
        ];
    }
}
