<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CommentResource;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function index(Request $request, Invitation $invitation){
        $invitations = [];

        if($request->id > 0){
            $invitations[] = User::find($request->id);
        }
        else{
            $invitations = $invitation->withOrder($request->sort)
                ->paginate($request->limit, ['*'], 0, $request->page);
        }

        foreach($invitations as $value){
            $list[] = [
                'id' => $value->id,
                'user_id' => $value->user_id,
                'title' => $value->title,
                'content_text' => $value->content_text,
                'content_img' => $value->content_img,
                'favorite_num' => $value->favorite_num,
                'status' => $value->status,
                'created_at' => $value->created_at,
                'updated_at' => $value->updated_at,
            ];
        }

        return response()->json([
            'code' => 20000,
            'list' => $list,
            'total' => Invitation::count(),
        ]);
    }

    public function show(Invitation $invitation)
    {
        $comments = $invitation->commentes;

        return response()->json([
            'code' => 20000,
            'state' => 1,
            'id' => $invitation->id,
            'user_id' => $invitation->user_id,
            'title' => $invitation->title,
            'content_text' => $invitation->content_text,
            'content_img' => $invitation->content_img,
            'favorite_num' => $invitation->favorite_num,
            'created_at' => $invitation->created_at,
            'status' => $invitation->status,
            'comment_list' => CommentResource::collection($comments)
        ]);
    }

	public function destroy(Invitation $invitation)
	{
        // $this->authorize('destroy', $user);
        $id = $invitation->id;
        $invitation->status = 3;

        $invitation->save();

        return response()->json([
            'code' => 20000,
            'id' => $id,
            'status' => $invitation->status,
        ]);
	}
}
