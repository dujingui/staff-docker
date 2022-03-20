<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FeedbackRequest;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function store(FeedbackRequest $request, Feedback $feedback)
    {
        $user = Auth::guard('api')->user();

        $feedback->user_id = $user->user_id;
        $feedback->content = $request->content;
        $feedback->contact_way = $request->contact_way;
        $feedback->content_img = $request->content_img;
        $feedback->save();

        return response()->json([
            'state' => 1,
            'id' => $feedback->id,
            'user_id' => $user->user_id,
        ]);
    }
}
