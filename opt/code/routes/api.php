<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')
    ->namespace('Api')
    // ->middleware('change-locale')
    ->name('api.v1.')
    ->group(function () {
    Route::middleware('throttle:' . config('api.rate_limits.sign'))
        ->group(function () {
        // 用户注册
        Route::post('users', 'UsersController@store')
            ->name('users.store');
        // 登录
        Route::post('authorizations', 'AuthorizationsController@store')
            ->name('authorizations.store');
    });

    Route::middleware('throttle:' . config('api.rate_limits.access'))
        ->group(function () {



        /***********************后台api***********************/

        // 登录
        Route::post('userlist', 'Admin\AdminController@login')
            ->name('userlist.login');
        // 获取用户信息
        Route::get('userinfo', 'Admin\AdminController@getLoginInfo')
            ->name('userlist.info');


        // 获取用户列表
        Route::get('userlist', 'Admin\UsersController@index')
            ->name('userlist.index');
        // 删除用户
        Route::delete('userlist/{user}', 'Admin\UsersController@destroy')
            ->name('userlist.destory');
        // 获取帖子列表
        Route::get('invitationlist', 'Admin\InvitationController@index')
            ->name('invitationlist.index');
        // 获取帖子详情
        Route::get('invitationlist/{invitation}', 'Admin\InvitationController@show')
            ->name('invitationlist.show');
        // 获取帖子详情
        Route::delete('invitationlist/{invitation}', 'Admin\InvitationController@destroy')
            ->name('invitationlist.destroy');
        // 获取练习数据
        Route::get('practice', 'Admin\PracticeController@index')
            ->name('practice.index');
        // 获取反馈数据
        Route::get('feedback', 'Admin\FeedbackController@index')
        ->name('feedback.index');
        /***********************后台api***********************/



        Route::middleware('auth:api')->group(function() {
            // 编辑登录用户信息
            Route::patch('user', 'UsersController@update')
                ->name('user.update');
            // 编辑登录用户的练习信息
            Route::patch('practice', 'PracticeController@update')
                ->name('practice.update');
            // 当前登录用户的错误列表
            Route::get('errornotes', 'ErrorNoteController@index')
                ->name('errornotes.index');
            // 编辑当前登录用户的错误列表
            Route::patch('errornotes', 'ErrorNoteController@update')
                ->name('errornotes.update');
            //获取关注的好友
            Route::get('followings', 'UsersController@followings')
                ->name('followings');
            //获取粉丝
            Route::get('followers', 'UsersController@followers')
                ->name('followers');
            // 关注
            Route::patch('follow', 'UsersController@follow')
                ->name('follow');
            // 发帖
            Route::post('invitation', 'InvitationController@store')
                ->name('invitation.store');
            // 删除帖子
            Route::delete('invitation/{invitation}', 'InvitationController@destroy')
                ->name('invitation.destroy');
            // 举报帖子
            Route::post('report', 'ReportController@store')
                ->name('report.store');
            // 获取帖子列表
            Route::get('invitation', 'InvitationController@index')
                ->name('invitation.index');
            // 获取帖子详情
            Route::get('invitation/{invitation}', 'InvitationController@show')
                ->name('invitation.show');
            // 点赞帖子
            Route::patch('invitation/{invitation}/favorite', 'InvitationController@favorite')
                ->name('invitation.favorite');
            // 收藏帖子
            Route::patch('invitation/{invitation}/collect', 'InvitationController@collect')
                ->name('invitation.collect');
            // 评论
            Route::post('invitation/{invitation}/comments', 'CommentController@store')
                ->name('invitation.comments.store');
            // 点赞评论
            Route::patch('invitation/{invitation}/comments/{comment}/favorite', 'CommentController@favorite')
                ->name('invitation.comments.favorite');
            // 回复评论
            Route::post('invitation/{invitation}/comments/{comment}/reples', 'ReplesController@store')
                ->name('invitation.comments.reples.store');
            // 反馈
            Route::post('feedback', 'FeedbackController@store')
                ->name('feedback.store');
            // 上传图片
            Route::post('images', 'ImagesController@store')
                ->name('images.store');
            // 获取排名
            Route::get('rank', 'RankController@show')
                ->name('rank.show');
            // 上传成绩
            Route::patch('rank', 'RankController@update')
                ->name('rank.update');
        });
    });
});
