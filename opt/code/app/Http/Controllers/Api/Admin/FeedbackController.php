<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index(Request $request, Feedback $feedback){
        $invitations = Feedback::paginate($request->limit, ['*'], 0, $request->page);

        $list = [];

        foreach($invitations as $value){
            $list[] = [
                'id' => $value->id,
                'user_id' => $value->user_id,
                'content' => $value->content,
                'contact_way' => $value->contact_way,
                'content_img' => $value->content_img,
                'created_at' => $value->created_at,
            ];
        }

        return response()->json([
            'code' => 20000,
            'list' => $list,
            'total' => Feedback::count(),
        ]);
    }
}
