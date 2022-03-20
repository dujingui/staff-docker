<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public $tokenData;

    public function __construct($resource, $tokenData)
    {
        $this->resource = $resource;
        $this->tokenData = $tokenData;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $practice = $this->practice;
        $follower_ids = $this->followers->pluck('user_id')->toArray();
        $following_ids = $this->followings->pluck('user_id')->toArray();

        return [
            'state' => 1,
            'user_id' => $this->user_id,
            'avatar_url' => $this->avatar_url,
            'nickname' => $this->nickname,
            'created_at' => $this->created_at,
            'birthday' => $this->birthday,
            'education' => $this->education,
            'gender' => $this->gender,
            'flowerings_list' => implode(',',$following_ids),
            'follower_list' => implode(',',$following_ids),
            'collect_list' => $this->collect_list,
            'favorite_invitation_list' => $this->favorite_invitation_list,
            'favorite_comment_list' => $this->favorite_comment_list,
            'access_token' => isset($this->tokenData['access_token']) ? $this->tokenData['access_token'] : '',
            'token_type' => isset($this->tokenData['token_type']) ? $this->tokenData['token_type'] : '',
            'expires_in' => isset($this->tokenData['expires_in']) ? $this->tokenData['expires_in'] : '',
            'total_practice_time' => $practice->total_practice_time,
            'total_practice_count' => $practice->total_practice_count,
            'total_practice_num' => $practice->total_practice_num,
            'total_practice_error_num' => $practice->total_practice_error_num,
            'practice_num_1' => $practice->practice_num_1,
            'practice_error_num_1' => $practice->practice_error_num_1,
            'practice_num_2' => $practice->practice_num_2,
            'practice_error_num_2' => $practice->practice_error_num_2,
            'practice_num_3' => $practice->practice_num_3,
            'practice_error_num_3' => $practice->practice_error_num_3,
            'practice_num_4' => $practice->practice_num_4,
            'practice_error_num_4' => $practice->practice_error_num_4,
            'everyday_target_num' => $practice->everyday_target_num,
            'everyday_prompt_time' => $practice->everyday_prompt_time,
            'today_practice_num' => $practice->today_practice_num,
            'today_practice_time' => $practice->today_practice_time,
            'last_practice_time' => $practice->last_practice_time,
            'last_practice_index' => $practice->last_practice_index,
            'last_model' => $practice->last_model,
            'last_note_group_index' => $practice->last_note_group_index,
        ];
    }
}
