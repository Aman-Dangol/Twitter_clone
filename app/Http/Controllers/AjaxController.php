<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    //
    public function tweets()
    {
        $data = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.userID')
            ->select(['posts.id', 'users.username', 'posts.userID', 'posts.tweetText'])
            ->selectRaw('(select count(*) from likes where likes.postID = posts.id) as likecount ')
            ->orderBy('posts.updated_at', 'desc')
            ->get();

        $liked = DB::table('likes')
            ->select('postID')
            ->where('likes.userID', '=', Auth::id())
            ->get();

        return view('tweet_section', [
            'data' => $data,
            'liked' => $liked
        ])->render();
    }

    public function like(Request $req)
    {
        $data = [
            'postID' => $req->id,
            'userID' => Auth::id()
        ];
        Like::create($data);
        return response()->json();
    }
}
