<?php

namespace Database\Seeders;

use App\Models\ErrorNotes;
use App\Models\HighestScore;
use App\Models\Practice;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 生成数据集合
        User::factory()->count(100)->create();
        Practice::factory()->count(100)->create();
        ErrorNotes::factory()->count(100)->create();
        ErrorNotes::factory()->count(100)->create();
        // HighestScore::factory()->count(100)->create();

        $users = User::all();
        $practices = Practice::all();
        $errorNotes = ErrorNotes::all();
        // $highestScore = HighestScore::all();

        foreach($users as $key => $value) {
            $value->account = '1511071' . str_pad($key, 4, "0", STR_PAD_LEFT);
            $value->save();

            $practices[$key]->user_id = $value->user_id;
            $practices[$key]->save();

            $errorNotes[$key]->user_id = $value->user_id;
            $errorNotes[$key]->save();

            // $highestScore[$key]->user_id = $value->user_id;
            // $highestScore[$key]->save();
        }

        // // 单独处理第一个用户的数据
        // $user = User::find(1);
        // $user->name = '水门';
        // $user->email = '15110711517@163.com';
        // $user->avatar = '/uploads/images/avatars/202202/21/2_1645426583_qZwZ0JcDnN.jpg';
        // $user->assignRole('Founder');
        // $user->save();

        // // 将 2 号用户指派为『管理员』
        // $user = User::find(2);
        // $user->assignRole('Maintainer');
        // $user->save();
    }
}
