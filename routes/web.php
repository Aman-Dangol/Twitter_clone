<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\TwitterController;
use App\Models\Post;
use Illuminate\Http\Client\Request;
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
Route::get('/like', [AjaxController::class, 'like']);
