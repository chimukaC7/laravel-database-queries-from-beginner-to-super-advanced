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

    // $result = Comment::find(1);
    // $result->rating = 4;
    // $result->save();

    $result = User::select([
        'users.*',
        'last_commented_at' => Comment::selectRaw('MAX(created_at)')
            ->whereColumn('user_id', 'users.id')
    ])->withCasts([
        'last_commented_at' => 'datetime:Y-m-d' // date and datetime works only for array or json result
    ])->get()->toJson();

    dump($result);

    return view('welcome');
});
