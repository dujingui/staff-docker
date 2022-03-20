<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ErrorNoteResource;
use App\Models\ErrorNotes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ErrorNoteController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::guard('api')->user();

        $errorNotes = $user->errorNotes;

        if(!$errorNotes){
            return response()->json([
                'state' => 1,
                'list' => "",
            ]);
        }

        return response()->json([
            'state' => 1,
            'user_id' => $user->user_id,
            'list' => $errorNotes->error_note_list,
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::guard('api')->user();

        $errorNotes = $user->errorNotes;

        $attributes = $request->all();

        if($errorNotes){
            $errorNotes->update($attributes);
        }
        else{
            ErrorNotes::create([
                'user_id' => 1,
                'error_note_list' => 11
            ]);
        }

        return response()->json([
            'state' => 1,
        ]);
    }
}
