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

    // $result = User::find(1); // [1,2,3] does not work with Query Builder
    // $result = User::where('email','like', '%@%')->first();

    // $result = User::where('email','like', '%@email2.com')->firstOr(function() {
    //         User::where('id',1)->update(['email'=>'email@email2.com']);
    // });

    // $result = User::findOrFail(100); // firstOrFail also possible

    // $result = Comment::max('rating'); //  count, max, min, avg, sum 

    // $result = Comment::all();
    // $result = Comment::withoutGlobalScope('rating')->get();
    $result = Comment::rating(1)->get();

    dump($result);

    return view('welcome');
});
