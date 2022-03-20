<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    protected $table = "t_invitation";
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'title',
        'content_text',
        'content_img',
        'favorite_num',
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

    public function commentes(){
        return $this->hasMany(Comment::class, "invitation_id", 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function scopeRecentReplied($query)
    {
        // 当话题有新回复时，我们将编写逻辑来更新话题模型的 reply_count 属性，
        // 此时会自动触发框架对数据模型 updated_at 时间戳的更新
        return $query->orderBy('updated_at', 'desc');
    }

    public function scopeRecent($query)
    {
        // 按照创建时间排序
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeHotest($query)
    {
        return $query->orderBy('favorite_num', 'desc');
    }

    public function scopeOrderByID($query, $order)
    {
        // 按照创建时间排序
        return $query->orderBy('id', $order);
    }

    public function scopeWithOrder($query, $order)
    {
        // 不同的排序，使用不同的数据读取逻辑
        switch ($order) {
            case '+id':
                $query->orderByID('asc');
                break;
            case '-id':
                $query->orderByID('desc');
                break;
            case '-time':
                $query->recent('desc');
                break;
            case '-favorite':
                $query->hotest('desc');
                break;
        }
    }
}
