<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\TwitterController;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [TwitterController::class, 'index'])->name('home-page')->middleware('auth');
Route::post('/tweet', [TwitterController::class, 'tweet'])->name('tweet');
Route::get('/signup', [TwitterController::class, 'signup'])->name('signup');
Route::post('/signin', [TwitterController::class, 'signin'])->name('signin');
Route::get('/login', [TwitterController::class, 'login'])->name('login');
Route::get('/logout', [TwitterController::class, 'logout'])->name('logout');
Route::post('/store', [TwitterController::class, 'store'])->name('store');
Route::post('ajaxReq', [AjaxController::class, 'tweets']);
Route::get('/like', [AjaxController::class, 'like'])->name('like');
Route::get('/unlike', [AjaxController::class, 'unlike']);
Route::get('/comment/{id}', [TwitterController::class, 'comments']);
Route::get('/addcomment', [TwitterController::class, 'addComment']);
Route::post('/deletePost', [AjaxController::class, 'deletePost']);
Route::get('/updateTweet', [TwitterController::class, 'updateTweet']);
Route::post('/update', [TwitterController::class, 'update']);
Route::get('/follow/{id}', [TwitterController::class, 'follow']);
Route::get('/unfollow/{id}', [TwitterController::class, 'unfollow']);
Route::get('/profile/{id}', [TwitterController::class, 'profile']);
Route::post('try', function () {
  $data =  DB::table('posts')
    ->join('users', 'users.id', '=', 'posts.userID')
    ->leftJoin('likes', 'likes.postID', '=', 'posts.id')
    ->select(['posts.id', 'users.username', 'posts.userID', 'posts.tweetText'])
    ->selectRaw('COUNT(likes.postID) AS likeCount')
    ->selectRaw('CASE WHEN EXISTS (SELECT 1 FROM likes WHERE likes.postID = posts.id AND likes.userID = ?) THEN 1 ELSE 0 END AS userLiked', [Auth::id()])
    ->selectRaw('CASE WHEN EXISTS (SELECT 1 FROM follows WHERE  follows.followerID = ?) THEN 1 ELSE 0 END AS userFollow', [Auth::id()])
    ->selectRaw('CASE WHEN EXISTS (SELECT 1 FROM follows WHERE follows.followerID = ? AND follows.followingID = posts.userID) THEN 1 ELSE 0 END AS userFollow', [Auth::id()])
    ->groupBy('posts.id')
    ->where('posts.userID', '=', Auth::id())
    ->orderBy('posts.updated_at', 'desc')
    ->get();
  return view('yourPost', ['posts' => $data])->render();
});
