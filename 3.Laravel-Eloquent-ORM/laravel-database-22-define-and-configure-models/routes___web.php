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

    //we will discuss the basics of Laravel Eloquent, which is another way of querying a database.
    //Unlike in the query builder, we query database using her model files.

    $result = DB::table('rooms')
                ->where('room_size',3)
                ->get();

    //every method available on DB facade is also available on 
    $result = Room::where('room_size',3)
                ->get();

    $result = Room::get(); // all()
    $result = Room::where('price', '<', 400)
                    ->get();
                    //without specifying the a select it will fetch all the columns

    $result = User::select('name','email')
        ->addSelect(['worst_rating' => Comment::select('rating')
        ->whereColumn('user_id', 'users.id')
        ->orderBy('rating', 'asc')
        ->limit(1)
        ])->get()->toArray();

    $result = User::orderByDesc(  // asc default without 'Desc' part
        Reservation::select('check_in')
            ->whereColumn('user_id','users.id')
            ->orderBy('check_in','desc') // asc default without argument
            ->limit(1)
        )->select('id','name')->get()->toArray();

    $result = Reservation::chunk(2, function ($reservations) {
        foreach ($reservations as $reservation) {
            echo $reservation->id;
        }
    }); // uses less memory than get() and cursor() but takes longer than get() and cursor(), the bigger chunk set is the less time a query takes but memory usage increases

    // foreach (Room::cursor() as $reservation) {
    //     echo $reservation->id;
    // } // takes faster than get() and chunk() but uses more memory than chunk() (not as much as get() method)

    // dump($result);

    return view('welcome');
});
