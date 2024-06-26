<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Follow;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use function Laravel\Prompts\error;

class TwitterController extends Controller
{
   public function index()
   {
      return view("welcome");
   }
   public function tweet(Request $request)
   {
      $request->validate([
         'tweetText' => 'required'
      ]);
      $tweetersID = Auth::id();
      $tweetText = $request->tweetText;
      $parsedData = [
         'userID' => $tweetersID,
         "tweetText" => $tweetText
      ];
      Post::create($parsedData);
      return redirect(route("home-page"));
   }
   public function signup()
   {
      return view("signup");
   }
   public function signin(Request $request)
   {
      $request->validate([
         'email' => ['required', 'email'],
         'password' => 'required'
      ]);
      if (Auth::attempt([
         'email' => $request->email,
         'password' => $request->password
      ])) {
         return redirect(route("home-page"));
      }
      return redirect()->back()->withErrors(['password' => 'Incorrect email or password.']);
   }
   public function login()
   {
      return view("login");
   }
   // storing register form ko data in database
   public function store(Request $request)
   {
      $data = $request->validate([
         'email' => ["required", "unique:users"],
         'username' => "required",
         'password' => "required"
      ]);
      $parsedData = [
         'email' => $request->email,
         'username' => $request->username,
         'password' => bcrypt($request->password),
      ];
      User::create($parsedData);

      return redirect(route('login'));
   }
   // logout 
   public function logout()
   {
      Auth::logout();
      return redirect(route("home-page"));
   }



   // display comments

   public function comments($ID)
   {
      $data = DB::table('comments')
         ->join('users', 'users.id', '=', 'comments.userID')
         ->select(['users.id', 'users.username', 'comments.commentText', 'comments.id as commentID'])
         ->where('comments.postID', '=', $ID)
         ->orderBy('comments.updated_at', 'desc')
         ->get();

      $mainPost =  DB::table('posts')
         ->join('users', 'users.id', '=', 'posts.userID')
         ->leftJoin('likes', 'likes.postID', '=', 'posts.id')
         ->select(['posts.id', 'users.username', 'posts.userID', 'posts.tweetText'])
         ->selectRaw('COUNT(likes.postID) AS likeCount')
         ->selectRaw('CASE WHEN EXISTS (SELECT 1 FROM likes WHERE likes.postID = posts.id AND likes.userID = ?) THEN 1 ELSE 0 END AS userLiked', [Auth::id()])
         ->groupBy('posts.id')
         ->orderBy('posts.updated_at', 'desc')
         ->where('posts.id', '=', $ID)
         ->get();
      return view('commentSection', [
         'mainPost' => $mainPost,
         'comments' => $data,
      ]);
   }
   // add a comment
   public function addComment(Request $req)
   {
      $req->validate([
         'commentText' => 'required'
      ]);
      $data = [
         'commentText' => $req->commentText,
         'postID' => $req->postID,
         'userID' => Auth::id()
      ];
      Comment::create($data);
      return redirect()->back();
   }
   // display update tweet page
   public function updateTweet(Request $req)
   {
      $data = DB::table('posts')
         ->where('posts.id', '=', $req->id)
         ->get();
      return view('updateTweet', ['data' => $data]);
   }

   // update tweet

   public function update(Request $req)
   {
      $data = Post::find($req->id);
      $data->tweetText = $req->updatedText;
      $data->save();
      return redirect(route('home-page'));
   }
   // when someone(auth) follows somebody
   public function follow($id)
   {
      $data = [
         'followerID' => Auth::id(),
         'followingID' => $id
      ];
      Follow::create($data);
      return redirect()->back();
   }
   public function unfollow($id)
   {
      DB::table('follows')
         ->where('followerID', Auth::id())
         ->where('followingID', $id)
         ->delete();
      return redirect()->back();
   }

   // display profile page\
   public function profile($id)
   {
      $followersList = Follow::where('follows.followingID', $id)
         ->join('users', 'follows.followerID', '=', 'users.id')
         ->select('follows.followingID', 'users.id', 'users.username')
         ->get();;
      $followingList = Follow::where('follows.followerID', $id)
         ->join('users', 'follows.followingID', '=', 'users.id')
         ->select('follows.followerID', 'users.id', 'users.username')
         ->get();;
      $follows = Follow::where('followerID', Auth::id())->where('followingID', $id)->count();
      $followers = Follow::where('followingID', '=', $id)->count();
      $following = Follow::where('followerID', '=', $id)->count();
      return view('profile', [
         'user' => User::find($id),
         'followers' => $followers,
         'following' => $following,
         'follows' => $follows,
         'followersList' => $followersList,
         'followingList' => $followingList
      ]);
   }
   // display profile's posts
   function profilePosts(Request $req)
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
         ->where('posts.userID', '=', $req->id)
         ->orderBy('posts.updated_at', 'desc')
         ->get();
      return view('yourPost', ['posts' => $data])->render();
   }
   function search(Request $req)
   {
      $users = User::where(function ($query) use ($req) {
         $query->where('username', 'REGEXP', $req->s);
      })->select(['users.username', 'users.id'])
         ->get();

      return view('search', ['results' => $users, 's' => $req->s]);
   }

   function settings()
   {
      return view('settings');
   }
}
