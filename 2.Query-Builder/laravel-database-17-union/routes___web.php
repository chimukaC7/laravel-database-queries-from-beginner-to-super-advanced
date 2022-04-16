<?php

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

    // $users = DB::table('users')
    //         ->select('name');

    // $result = DB::table('cities')
    //         ->select('name')
    //         ->union($users)
    //         ->get();

    $room = DB::table('comments')
            ->select('rating as rating_or_room_id','id', DB::raw('"comments" as type_of_activity'))
            ->where('user_id',2);
            //there is not get()

    $result = DB::table('reservations')
            ->select('room_id as rating_or_room_id', 'id', DB::raw('"reservation" as type_of_activity'))
            ->union($room)
            ->where('user_id',2)
            ->get();
            //the column types must be the same


    dump($result);

    return view('welcome');
});

// order_id  | client_id | order_date | order_amount

// refund_id  | client_id | refund_date |  refund_amount 
