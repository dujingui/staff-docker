<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HighestScore extends Model
{
    use HasFactory;

    protected $table = "t_highest_scores";
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'note_group_index',
        'practice_mode',
        'practice_mode_index',
        'practice_time',
        'practice_num',
    ];
}
