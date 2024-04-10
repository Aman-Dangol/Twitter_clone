<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    //
    public function tweets()
    {
        $content = DB::table('users')->join('posts', 'users.id', '=', 'posts.userID')->select('users.*', 'posts.*')->get();
        return view('tweet_section', ['content' => $content])->render();
    }
}
