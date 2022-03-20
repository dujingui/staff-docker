<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = "t_reportes";
    protected $primaryKey = 'id';

    protected $fillable = [
        'invitation_id',
        'report_type',
    ];
}
