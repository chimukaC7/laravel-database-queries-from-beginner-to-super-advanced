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

    // $comment = Comment::find(1);
    // $comment->user_id = 1;
    // $comment->rating = 5;
    // $comment->content = 'comment content updated';
    // $result = $comment->save(); 

    $result = Room::where('price', '<', 200)
          ->update(['price' => 250]);

    dump($result);

    return view('welcome');
});
