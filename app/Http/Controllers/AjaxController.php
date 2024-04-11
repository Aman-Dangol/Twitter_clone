<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    //
    public function tweets()
    {
        $content = DB::table('users')
            ->join('posts', 'users.id', '=', 'posts.userID')
            ->select('users.*', 'posts.*')
            ->orderBy('posts.created_at', 'desc')
            ->get();


        $data = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.userID')
            ->select(['posts.id', 'users.username', 'posts.userID', 'posts.tweetText'])
            ->selectRaw('(select count(*) from likes where likes.postID = posts.id) as likecount ')
            ->orderBy('posts.updated_at', 'desc')
            ->get();


        return view('tweet_section', [
            'content' => $content,
            'data' => $data
        ])->render();
    }
}
