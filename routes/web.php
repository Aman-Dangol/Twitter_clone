<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\TwitterController;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
Route::post('userPosts', [TwitterController::class, 'profilePosts']);
Route::get('/search', [TwitterController::class, 'search']);
Route::get('/settings', [TwitterController::class, 'settings']);
Route::get('/deleteAcc/{id}', function ($id) {
  $user = User::find($id);
  $user->delete();
  return redirect(route('home-page'));
});
Route::get('/changePassword', function () {
  return view("changePassword");
});
Route::post('/changepass', function (Request $request) {
  $request->validate([
    'oldPass' => ['required'],
    'newPass' => ['required']
  ]);
  if (Auth::attempt([
    'email' => Auth::user()->email,
    'password' => $request->oldPass
  ])) {
    $user = User::find(Auth::id());
    $user->password = bcrypt($request->newPass);
    $user->save();
    Auth::logout();
    return redirect(route('home-page'));
  } else {
    return response("incorect");
  }
});
