<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PracticeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 0,
            'total_practice_time' => 0,
            'total_practice_count' => 0,
            'total_practice_num' => 0,
            'total_practice_error_num' => 0,
            'practice_num_1' => 0,
            'practice_error_num_1' => 0,
            'practice_num_2' => 0,
            'practice_error_num_2' => 0,
            'practice_num_3' => 0,
            'practice_error_num_3' => 0,
            'practice_num_4' => 0,
            'practice_error_num_4' => 0,
            'everyday_target_num' => 0,
            'everyday_prompt_time' => "",
            'today_practice_num' => 0,
            'today_practice_time' => 0,
            'last_practice_time' => 0,
            'last_practice_index' => 0,
            'last_model' => 0,
            'last_note_group_index' => 0,
        ];
    }
}
