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

    //we use raw sql expressions when laravel does not support
    //the raw sql is not the entire query,only the where clause

    //What is the advantage of using this over raw expression?
    //We can very easily switch between databases that Laravel supports

    // $result = DB::table('comments')
    // ->where("content", 'like', '%inventore%')
    // ->whereRaw("content LIKE '%inventore%'") // be careful about SQL injections!
    // ->where(DB::raw("content LIKE '%inventore%'")) // not working because where() needs two parameters
    // ->get();

    // $result = DB::table('comments')
    //     // ->select(DB::raw('count(user_id) as number_of_comments, users.name'))
    //     ->selectRaw('count(user_id) as number_of_comments, users.name',[])
    //     ->join('users','users.id','=','comments.user_id')
    //     ->groupBy('user_id')
    //     ->get();

    // whereRaw / orWhereRaw
    // havingRaw / orHavingRaw
    // orderByRaw
    // groupByRaw

    // $result = DB::table('comments')
    //             ->orderByRaw('updated_at - created_at DESC')
    //             ->get();

    $result = DB::table('users')
                ->selectRaw('LENGTH(name) as name_lenght, name')
                ->orderByRaw('LENGTH(name) DESC')
                ->get();
                
    dump($result);

    return view('welcome');
});

