<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CommentRequest;
use App\Http\Requests\Api\InvitaionRequest;
use App\Http\Resources\Api\CommentResource;
use App\Http\Resources\Api\InvitationResource;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvitationController extends Controller
{
    public function index(Request $request, Invitation $invitation)
    {
        $type = $request->type;

        $user = Auth::guard('api')->user();

        $invitationes = null;

        if($type == 0){
            $invitationes = $invitation->recentReplied()->with('user')->get();  // 预加载防止 N+1 问题
        }
        elseif($type == 1){
            $invitationes = $invitation->hotest()->with('user')->get();  // 预加载防止 N+1 问题
        }
        elseif($type == 2){
            $invitationes = $user->followingsInvitativon()->get();
        }
        elseif($type == 3){
            $invitationes = $user->invitativones;
        }
        elseif($type == 4){
            // $collect_ids = $user->collect_list->pluck('id')->toArray();
            $collect_ids = explode(',', $user->collect_list);
            $invitationes = Invitation::whereIn('id', $collect_ids)
                              ->with('user')
                              ->orderBy('updated_at', 'desc');
        }

        $invitationList = InvitationResource::collection($invitationes);

        return response()->json([
            'state' => 1,
            'list' => $invitationList
        ]);
    }

    public function show(Invitation $invitation)
    {
        $user = Auth::guard('api')->user();

        $comments = $invitation->commentes;

        return response()->json([
            'state' => 1,
            'id' => $invitation->id,
            'user_id' => $user->user_id,
            'comment_list' => CommentResource::collection($comments)
        ]);
    }

    public function favorite(Invitation $invitation)
    {
        $user = Auth::guard('api')->user();
        $invitationID = $invitation->id;

        $invitation_ids = explode(',', $user->favorite_invitation_list);

        if(!$user->favorite_invitation_list){
            $invitation_ids = [];
        }

        if(in_array($invitationID, $invitation_ids)){
            $key = array_search($invitationID, $invitation_ids);

            unset($invitation_ids[$key]);
        }
        else{
            $invitation_ids[] = $invitationID;
        }

        $user->update(['favorite_invitation_list' => implode(',',$invitation_ids)]);
        $invitation->update(['favorite_num' => count($invitation_ids)]);

        return response()->json([
            'state' => 1,
            'user_id' => $user->user_id,
            'invitation_id' => $invitationID,
            'favorite_num' => count($invitation_ids),
            'favorite_list' => implode(',',$invitation_ids),
        ]);
    }

    public function collect(Invitation $invitation)
    {
        $user = Auth::guard('api')->user();
        $invitationID = $invitation->id;

        $collect_ids = explode(',', $user->collect_list);

        if(!$user->collect_list){
            $collect_ids = [];
        }

        if(in_array($invitationID, $collect_ids)){
            $key = array_search($invitationID, $collect_ids);

            unset($collect_ids[$key]);
        }
        else{
            $collect_ids[] = $invitationID;
        }

        $user->update(['collect_list' => implode(',',$collect_ids)]);

        return response()->json([
            'state' => 1,
            'user_id' => $user->user_id,
            'collect_list' => implode(',',$collect_ids),
        ]);
    }

    public function store(InvitaionRequest $request, Invitation $invitation)
    {
        $user = Auth::guard('api')->user();

        $invitation->fill($request->all());
        $invitation->user_id = $user->user_id;
        $invitation->save();

        return new InvitationResource($invitation);
    }

    public function destroy(Invitation $invitation)
    {
        $user = Auth::guard('api')->user();

        $id = $invitation->id;

        $this->authorize('destroy', $invitation);
        $invitation->delete();

        return response()->json([
            'state' => 1,
            'user_id' => $user->user_id,
            'id' => $id,
        ]);
    }
}
