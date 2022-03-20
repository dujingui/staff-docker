<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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

        return [
            'state' => 1,
            'id' => $this->id,
            'user_id' => $this->user_id,
            'gender' => $user->gender,
            'avatar_url' => $user->avatar_url,
            'nickname' => $user->nickname,
            'invitation_id' => $this->invitation_id,
            'time' => $this->created_at,
            'favorite_num' => $this->favorite_num,
            'content' => $this->content,
            'reples' => ReplesResource::collection($this->reples),
        ];
    }
}
