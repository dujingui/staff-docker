<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Practice;
use Illuminate\Http\Request;

class PracticeController extends Controller
{
    public function index(Request $request, Practice $practice){
        $invitations = Practice::paginate($request->limit, ['*'], 0, $request->page);

        $list = [];

        foreach($invitations as $value){
            $list[] = [
                'id' => $value->id,
                'user_id' => $value->user_id,
                'total_practice_time' => $value->total_practice_time,
                'total_practice_count' => $value->total_practice_count,
                'total_practice_num' => $value->total_practice_num,
                'total_practice_error_num' => $value->total_practice_error_num,
                'practice_num_1' => $value->practice_num_1,
                'practice_error_num_1' => $value->practice_error_num_1,
                'practice_num_2' => $value->practice_num_2,
                'practice_error_num_2' => $value->practice_error_num_2,
                'practice_num_3' => $value->practice_num_3,
                'practice_error_num_3' => $value->practice_error_num_3,
                'practice_num_4' => $value->practice_num_4,
                'practice_error_num_4' => $value->practice_error_num_4,
                'everyday_target_num' => $value->everyday_target_num,
                'everyday_prompt_time' => $value->everyday_prompt_time,
                'today_practice_num' => $value->today_practice_num,
                'today_practice_time' => $value->today_practice_time,
                'last_practice_time' => $value->last_practice_time,
                'last_practice_index' => $value->last_practice_index,
                'last_model' => $value->last_model,
                'last_note_group_index' => $value->last_note_group_index,
                'created_at' => $value->created_at,
                'updated_at' => $value->updated_at,
            ];
        }

        return response()->json([
            'code' => 20000,
            'list' => $list,
            'total' => Practice::count(),
        ]);
    }
}
