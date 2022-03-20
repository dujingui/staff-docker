<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reples extends Model
{
    use HasFactory;

    use HasFactory;

    protected $table = "t_reply";
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'target_user_id',
        'invitation_id',
        'comment_id',
        'favorite_num',
        'content',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'timestamp',
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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }


    public function targetUser()
    {
        return $this->belongsTo(User::class, 'target_user_id', 'user_id');
    }
}
