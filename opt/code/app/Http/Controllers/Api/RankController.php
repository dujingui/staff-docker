<?php

namespace App\Http\Controllers\Api;

use App\Handlers\RankHandler;
use App\Http\Controllers\Controller;
use App\Models\HighestScore;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RankController extends Controller
{
    public function show(Request $request)
    {
        $user = Auth::guard('api')->user();
        $user_id = $user->user_id;

        $noteGroupIndex = $request->noteGruopID;
        $practiceMode = $request->practiceMode;
        $practiceModeIndex = $request->practiceModeIndex;

        $key = sprintf("%d-%d-%d", $noteGroupIndex, $practiceMode, $practiceModeIndex);

        $ret = RankHandler::zrevrange($key, 0, -1, 'asc', true);

        // echo json_encode($ret);

        $rankList = $this->getRankList($ret);

        return response()->json([
            'self_rank' => RankHandler::zrevrank($key, $user_id, 'asc'),
            'self_gender' => $user->gender,
            'self_nickname' => $user->nickname,
            'self_avatar_url' => $user->avatar_url,
            'self_score' => RankHandler::zscore($key, $user_id),
            'list' => $rankList,
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::guard('api')->user();
        $user_id = $user->user_id;

        $noteGroupIndex = $request->noteGruopID;
        $practiceMode = $request->practiceMode;
        $practiceModeIndex = $request->practiceModeIndex;

        $practiceTime = $request->practiceTime;
        $practiceNum = $request->practiceNum;

        $key = sprintf("%d-%d-%d", $noteGroupIndex, $practiceMode, $practiceModeIndex);
        $score = $practiceMode == 0 ? $practiceTime : $practiceNum;

        $newRecord = false;

        $highestScore = $user->highestScore($noteGroupIndex, $practiceMode, $practiceModeIndex);

        if(!$highestScore){
            $highestScore = HighestScore::create([
                'user_id' => $user_id,
                'note_group_index' => $noteGroupIndex,
                'practice_mode' => $practiceMode,
                'practice_mode_index' => $practiceModeIndex,
            ]);
        }

        if($practiceMode == 0){
            if($score < $highestScore->practice_time || $highestScore->practice_time == 0){
                //新纪录
                $newRecord = true;
                $highestScore->practice_time = $score;
            }
        }else if($practiceMode == 1){
            if($score > $highestScore->practice_num || $highestScore->practice_num == 0){
                //新纪录
                $newRecord = true;
                $highestScore->practice_num = $score;
            }
        }

        if($newRecord){
            $highestScore->save();
        }

        RankHandler::set($key, $user_id, $score);

        $ret = RankHandler::zrevrange($key, 0, -1, 'asc', true);

        $rankList = $this->getRankList($ret);

        return response()->json([
            'self_rank' => RankHandler::zrevrank($key, $user_id, 'asc'),
            'self_gender' => $user->gender,
            'self_nickname' => $user->nickname,
            'self_avatar_url' => $user->avatar_url,
            'self_score' => RankHandler::zscore($key, $user_id),
            'list' => $rankList,
            'new_record' => $newRecord,
        ]);
    }

    public function getRankList($rankRet)
    {
        $rankList = [];

        foreach($rankRet as $key => $value){
            $user_temp = User::find($key);
            $rankList[] = [
                'user_id' => $key,
                'nickname' => $user_temp->nickname,
                'gender' => $user_temp->gender,
                'avatar_url' => $user_temp->avatar_url,
                'score' => $value,
            ];
        }

        return $rankList;
    }
}
