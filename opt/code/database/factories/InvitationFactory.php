<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InvitationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $sentence = $this->faker->sentence();
        return [
            'user_id' => $this->faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
            'title' => $sentence,
            'content_text' => $this->faker->text(),
            'content_img' => '/uploads/images/topics/202202/21/1_1645449853_1mxGRhBiMM.jpg',
            'favorite_num' => 1,
        ];
    }
}
