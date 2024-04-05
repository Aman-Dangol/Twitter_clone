<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
         'password' => $request->password,
      ];

      User::create($parsedData);
      return response("check workbench");
   }
}
