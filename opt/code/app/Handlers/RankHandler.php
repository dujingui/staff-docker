<?php
/**
 * Created by Zend Studio.
 * User: Xuzhz <857328943@qq.com>
 * name: Redis的ZSET 实现游戏排行榜实时刷新
 * Date: 2019年12月30日
 * Time: 下午4:30:23
 */
namespace App\Handlers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class RankHandler
{
    /**
    * 新增|更新 有序集合元素
    * @param : $key 集合名称; $value 用户标识id; $score 权重;
    * @return : boolean
    */
    public static function set($key, $value, $score)
    {
        try {
            Redis::ZADD($key, $score, $value);
            Log::info('用户分数接口：set，用户ID-'.$value.', 分数-'.$score.', 所属榜单-'.$key);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
    * 获取指定KEY排行榜倒序排名，可选择同时返回权重
    * @param : $key 集合名称; $start 开始下标; $stop 结束下标（-1全部）; $withscores 是(true)否(false)返回权重score
    * @return : array , 包含排名、value、score
    * date: 2019年12月30日下午4:46:11
    * author: xzz
    */
    public static function zrevrange($key, $start, $stop=-1, $order='desc', $withscores=true)
    {
        $rank = [];

        if($order == 'desc'){
            $rank = Redis::ZREVRANGE($key, $start, $stop, $withscores);
        }elseif($order == 'asc'){
            $rank = Redis::ZRANGE($key, $start, $stop, $withscores);
        }

        return $rank;
    }

    /**
    * 获取指定KEY集合中某value对应的排名
    * @param : $key 集合名称; $value 具体值（用户id）; $flag 是(true)否(false)倒序
    * @return : int or false
    * date: 2019年12月30日下午4:59:26
    * author: xzz
    */
    public static function zrevrank($key, $value, $order='desc')
    {
        $index = false;
        try {
            if ($order == 'desc') {
                $index = Redis::ZREVRANK($key, $value);
            }elseif($order == 'asc'){
                $index = Redis::ZRANK($key, $value);
            }
        } catch (\Exception $e) {
            return false;
        }

        return $index;
    }

    /**
     * 获取指定KEY集合中某value的实时权重
     * @param : $key 集合名称; $value 具体值（用户id）
     * @return : int or false
     * date: 2019年12月30日下午4:59:26
     * author: xzz
     */
    public static function zscore($key, $value)
    {
        $index = 0;
        try {
            $index = Redis::ZSCORE($key, $value);
        } catch (\Exception $e) {
            return false;
        }

        return $index;
    }
}
