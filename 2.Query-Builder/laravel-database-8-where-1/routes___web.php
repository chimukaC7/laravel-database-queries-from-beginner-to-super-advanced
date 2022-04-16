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

    $result = DB::table('rooms')->get();
    $result = DB::table('rooms')->where('price','<',200)->get(); // = like, etc.
    //if there only two arguments inside the where function,we are checking for equality
    //if there 3 arguments 

    $result = DB::table('rooms')
    ->where([
                ['room_size', '2'],//room size equals 2
                ['price', '<', '400'],//AND price less than 400
            ])
    ->get();
    //you can also pass an array as argument of where function
    //you can provide as many conditions as you like
    //all of them will be linked using AND

     $result = DB::table('rooms')
        ->where('room_size' ,'2')
        ->orWhere('price', '<' ,'400')
        ->get();
        //using or

    $result = DB::table('rooms')
            ->where('price', '<' ,'400')
            ->orWhere(function($query) {//you can also provide an anonymous function
                $query->where('room_size', '>' ,'1')
                      ->where('room_size', '<' ,'4');//and
            })
            ->get();
    //get all rooms with price less than 400 or where room_size greater than 1 AND room_size less than 4

    dump($result);

    return view('welcome');
});

