<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwitterController extends Controller
{
   public function index()
   {
      return view('welcome');
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
      return response($parsedData);
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
         return redirect(route('home-page'));
      } else {
         return response("something went wrong");
      }
   }
   public function login()
   {
      return view("login");
   }
   public function store(Request $request)
   {
      $data = $request->validate([
         'email' => "required",
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
      return redirect(route('home-page'));
   }
}
