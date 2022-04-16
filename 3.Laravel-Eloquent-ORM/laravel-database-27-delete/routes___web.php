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

    // $flight = Comment::find(1);
    // $result = $flight->delete();

    // $result = Comment::destroy([1]);

    // $result = Comment::where('rating', 1)->delete();

    // $result = Comment::withTrashed()->get(); // onlyTrashed()
    // $result = Comment::withTrashed()->restore(); // onlyTrashed()

    $result = Comment::where('rating', 1)->forceDelete();

    dump($result);

    return view('welcome');
});
