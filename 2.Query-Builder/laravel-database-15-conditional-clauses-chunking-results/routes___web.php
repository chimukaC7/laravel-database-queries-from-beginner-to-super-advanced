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

    $room_id = null;

    $result = DB::table('reservations')
                ->when($room_id, function($query, $room_id) {//conditional query
                     return $query->where('room_id', $room_id);
                })
                ->get();


    //$sortBy = null;
    $sortBy = "room_number";

    $result = DB::table('rooms')
                    ->when($sortBy, function ($query, $sortBy) {
                        return $query->orderBy($sortBy);
                    }, function ($query) {//executed when the condition query is null or false
                        return $query->orderBy('price');
                    })
                    ->get();

    //woks similar to get but it chunks database results into pieces
    //saves memory but is slower than standard query
    $result = DB::table('comments')->orderBy('id')->chunk(2, function ($comments) {//get 2 results at once
        //where we can do something with our chunks
        foreach ($comments as $comment)
        {
            if($comment->id == 5) return false;
        }
    });

    $result = DB::table('comments')->orderBy('id')->chunkById(5, function ($comments) {//get 5 results at once
        //using chunkById, we can perform operations such as update
        foreach ($comments as $comment)
        {
           DB::table('comments')
                ->where('id', $comment->id)
                ->update(['rating' => null]);
        }
    }); // useful for administration tasks

    $result = DB::table('comments')->get();

    dump($result);

    return view('welcome');
});

