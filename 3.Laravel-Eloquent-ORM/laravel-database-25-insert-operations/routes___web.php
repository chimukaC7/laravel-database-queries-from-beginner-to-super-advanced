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

    // $comment = new Comment();
    // $comment->user_id = 1;
    // $comment->rating = 5;
    // $comment->content = 'comment content';
    // $result = $comment->save(); 

    $result = Comment::create([
        'user_id' => 1,
        'rating' => 5,
        'content' => 'comment content',
    ]);

    dump($result);

    return view('welcome');
});
