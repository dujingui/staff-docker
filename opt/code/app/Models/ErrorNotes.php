<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErrorNotes extends Model
{
    protected $table = "t_error_note_list";
    protected $primaryKey = 'id';

    use HasFactory;

    protected $fillable = [
        'user_id',
        'error_note_list',
    ];
}
