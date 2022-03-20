<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ReplesRequest;
use App\Http\Resources\Api\ReplesResource;
use App\Models\Comment;
use App\Models\Invitation;
use App\Models\Reples;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplesController extends Controller
{
    public function store(ReplesRequest $request, Invitation $invitation, Comment $comment, Reples $reples)
    {
        $user = Auth::guard('api')->user();

        $reples->user_id = $user->user_id;
        $reples->target_user_id = (int)$request->target_user_id;
        $reples->invitation_id = $invitation->id;
        $reples->comment_id = $comment->id;
        $reples->favorite_num = 0;
        $reples->content = $request->content;
        $reples->save();

        return new ReplesResource($reples);
    }
}
