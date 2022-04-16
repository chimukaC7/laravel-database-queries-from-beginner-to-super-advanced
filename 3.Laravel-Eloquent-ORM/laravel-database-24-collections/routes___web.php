<?php

use App\Comment;
use App\Reservation;
use App\Room;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

  
    // $result = Comment::all()->toArray();
    // $result = Comment::all()->count();
    // $result = Comment::all()->toJson();
    
    $comments = Comment::all();

    $result = $comments->reject(function ($comment) {
        return $comment->rating < 3;
    });
    // ->map(function ($comment) {
    //     return $comment->content;
    // });

    $result = $comments->diff($result);

    dump($result);

    return view('welcome');
});
