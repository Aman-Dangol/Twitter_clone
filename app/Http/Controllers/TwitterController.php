<?php

namespace App\Http\Controllers;

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
      return response($request);
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
         return view('welcome');
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
      return response("check workbench");
   }
}
