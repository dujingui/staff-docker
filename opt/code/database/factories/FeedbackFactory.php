<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FeedbackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->randomElement([11, 20, 31, 4, 1, 63, 7, 84, 92, 10]),
            'content' => $this->faker->text(),
            'contact_way' => $this->faker->safeEmail(),
            'content_img' => "/uploads/images/topics/202202/21/1_1645449853_1mxGRhBiMM.jpg",
        ];
    }
}
