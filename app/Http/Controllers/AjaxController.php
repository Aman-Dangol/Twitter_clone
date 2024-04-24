<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    //
    public function tweets(Request $req)
    {
        $data =  DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.userID')
            ->leftJoin('likes', 'likes.postID', '=', 'posts.id')
            ->select(['posts.id', 'users.username', 'posts.userID', 'posts.tweetText'])
            ->selectRaw('COUNT(likes.postID) AS likeCount')
            ->selectRaw('CASE WHEN EXISTS (SELECT 1 FROM likes WHERE likes.postID = posts.id AND likes.userID = ?) THEN 1 ELSE 0 END AS userLiked', [Auth::id()])
            ->selectRaw('CASE WHEN EXISTS (SELECT 1 FROM follows WHERE  follows.followerID = ?) THEN 1 ELSE 0 END AS userFollow', [Auth::id()])
            ->selectRaw('CASE WHEN EXISTS (SELECT 1 FROM follows WHERE follows.followerID = ? AND follows.followingID = posts.userID) THEN 1 ELSE 0 END AS userFollow', [Auth::id()])
            ->groupBy('posts.id')
            ->orderBy('posts.updated_at', 'desc')
            ->get();
        return view('tweet_section', [
            'data' => $data,
            'type' => $req->type
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
    public function unlike(Request $req)
    {
        Like::where('userID', '=', Auth::id())->where('postID', '=', $req->id)->delete();
        return response()->json();
    }
    public function deletePost(Request $req)
    {
        Post::destroy($req->postID);
    }
}
