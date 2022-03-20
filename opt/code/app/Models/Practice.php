<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Practice extends Model
{
    use HasFactory;

    protected $table = "t_practice";

    protected $fillable = [
        'user_id',
        'total_practice_time',
        'total_practice_count',
        'total_practice_num',
        'total_practice_error_num',
        'practice_num_1',
        'practice_error_num_1',
        'practice_num_2',
        'practice_error_num_2',
        'practice_num_3',
        'practice_error_num_3',
        'practice_num_4',
        'practice_error_num_4',
        'everyday_target_num',
        'everyday_prompt_time',
        'today_practice_num',
        'today_practice_time',
        'last_practice_time',
        'last_practice_index',
        'last_model',
        'last_note_group_index',
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
    ];

    /**
     * Return a timestamp as unix timestamp.
     *
     * @param  mixed  $value
     * @return int
     */
    protected function asTimestamp($value)
    {
        return $this->asDateTime($value)->getTimestamp() * 1000;
    }
}
