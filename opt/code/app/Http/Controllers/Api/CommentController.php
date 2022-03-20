<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CommentRequest;
use App\Http\Resources\Api\CommentResource;
use App\Models\Comment;
use App\Models\Invitation;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(CommentRequest $request, Invitation $invitation, Comment $comment)
    {
        $user = Auth::guard('api')->user();

        $comment->user_id = $user->user_id;
        $comment->invitation_id = $invitation->id;
        $comment->content = $request->content;
        $comment->favorite_num = 0;
        $comment->save();

        return new CommentResource($comment);
    }

    public function favorite(Invitation $invitation, Comment $comment)
    {
        $user = Auth::guard('api')->user();
        $invitationID = $invitation->id;
        $commentID = $comment->id;

        $comment_ids = explode(',', $user->favorite_comment_list);

        if(!$user->favorite_comment_list){
            $comment_ids = [];
        }

        if(in_array($commentID, $comment_ids)){
            $key = array_search($commentID, $comment_ids);

            unset($comment_ids[$key]);
        }
        else{
            $comment_ids[] = $commentID;
        }

        $user->update(['favorite_comment_list' => implode(',',$comment_ids)]);
        $comment->update(['favorite_num' => count($comment_ids)]);

        return response()->json([
            'state' => 1,
            'user_id' => $user->user_id,
            'invitation_id' => $invitationID,
            'comment_id' => $commentID,
            'favorite_num' => count($comment_ids),
            'favorite_list' => implode(',',$comment_ids),
        ]);
    }
}
