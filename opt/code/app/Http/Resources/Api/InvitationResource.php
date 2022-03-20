<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class InvitationResource extends JsonResource
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
        $commentes = $this->commentes->toArray();

        return [
            'state' => 1,
            'id' => $this->id,
            'user_id' => $this->user_id,
            'time' => $this->created_at,
            'comment_num' => count($commentes),
            'favorite_num' => $this->favorite_num,
            'title' => $this->title,
            'content_text' => $this->content_text,
            'content_img' => $this->content_img,
            'avatar_url' => $user->avatar_url,
            'nickname' => $user->nickname,
            'gender' => $user->gender,
        ];
    }
}
