<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ReplesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $user = $this->user;
        $targetUser = $this->targetUser;

        return [
            'state' => 1,
            'id' => $this->id,
            'user_id' => $this->user_id,
            'avatar_url' => $user->avatar_url,
            'nickname' => $user->nickname,
            'comment_id' => $this->comment_id,
            'invitation_id' => $this->invitation_id,
            'time' => $this->created_at,
            'content' => $this->content,
            'favorite_num' => $this->favorite_num,
            'target_user_id' => $this->target_user_id,
            'target_nickname' => $targetUser->nickname,
        ];
    }
}
