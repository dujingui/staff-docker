<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Invitation;
use App\Models\Reples;
use Illuminate\Database\Seeder;

class InvitationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Invitation::factory()->count(100)->create();
        Comment::factory()->count(100)->create();
        Reples::factory()->count(100)->create();

        $reples = Reples::all();

        $comments = Comment::all();
        foreach($comments as $key => $value){
            if($key >= 10)break;

            $value->invitation_id = 1;
            $value->save();
        }

        foreach($reples as $key => $value){
            $comment = $comments->random();
            $value->target_user_id = $comment->user_id;
            $value->invitation_id = $comment->invitation_id;
            $value->comment_id = $comment->id;

            $value->save();
        }
    }
}
