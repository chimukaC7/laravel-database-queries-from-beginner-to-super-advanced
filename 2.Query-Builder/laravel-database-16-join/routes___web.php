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

    $result = DB::table('reservations')
            //join meaning only matching records will be fetch
            //prefix
            ->join('rooms','reservations.room_id', '=', 'rooms.id')
            ->join('users','reservations.user_id', '=', 'users.id')
            ->where('rooms.id', '>', 3)
            ->where('users.id', '>', 1)
            ->get();

    //We can write the same query in a different way in Laravel, which is slightly more readable.            
    $result = DB::table('reservations')
            ->join('rooms', function($join) {
                $join->on('reservations.room_id', '=', 'rooms.id')
                ->where('rooms.id', '>', 3);
            })
            ->join('users', function($join) {
                $join->on('reservations.user_id', '=', 'users.id')
                ->where('users.id', '>', 1);
            })
            ->get();

    //There is also another way of writing the same query using sub queries.
    $rooms = DB::table('rooms')
            ->where('id', '>', 3);

    $users = DB::table('users')
            ->where('id', '>', 1);

    $result = DB::table('reservations')
        ->joinSub($rooms, 'rooms', function ($join) {
            $join->on('reservations.room_id', '=', 'rooms.id');
        })
        ->joinSub($users, 'users', function ($join) {
            $join->on('reservations.user_id', '=', 'users.id');
        })
        ->get();


    $result = DB::table('rooms')
            ->leftJoin('reservations','rooms.id', '=', 'reservations.room_id')
            //Join means that we will get all the rooms regardless of whether the id of the room exists in reservations table or not.
            //inner join query would return only those rooms who have corresponding idea in reservation stable.
            //left join is useful when we want to fetch also non matching records from the database
            ->selectRaw('room_size, count(reservations.id) as reservations_count')
            ->groupBy('room_size')
            ->orderByRaw('count(reservations.id) DESC')
            ->get();
            //So we get all the rooms regardless of whatever.
            //by executing this query, we will get rooms with the number of reservations for each room, size and order by reservations count.

    $result = DB::table('rooms')
            ->leftJoin('reservations','rooms.id', '=', 'reservations.room_id')
            ->selectRaw('room_size, price, count(reservations.id) as reservations_count')
            ->groupBy('room_size','price')
            ->get();

    $result = DB::table('rooms')
            ->leftJoin('reservations', 'rooms.id', '=', 'reservations.room_id')
            ->leftJoin('cities', 'reservations.city_id', '=', 'cities.id')
            ->selectRaw('room_size, count(reservations.id) as reservations_count, cities.name')
            ->groupBy('room_size','cities.name')
            ->orderByRaw('count(reservations.id) DESC')
            ->get();

    $result = DB::table('rooms')
            ->crossJoin('cities')//returns all the possible combinations
            ->leftJoin('reservations', function($join){//returns combinations that satisfy the condition
                $join->on('rooms.id', '=', 'reservations.room_id')
                ->on('cities.id','=','reservations.city_id');
            })
            // ->selectRaw('room_size, count(reservations.id) as reservations_count, cities.name')
            ->selectRaw('count(reservations.id) as reservations_count, cities.name')
            ->groupBy(/*'room_size',*/'cities.name')
            ->orderByRaw('count(reservations.id) DESC')
            // ->orderBy('rooms.room_size', 'DESC')
            ->get();

    dump($result);

    return view('welcome');
});

