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

    $result = DB::table('users')
                ->orderBy('name', 'desc')
                ->get();

                //default ordering is asc
    $result = DB::table('users')
                ->latest() // order by desc,created_at default, you pass any column in the latest() function
                ->first();//last created user
                
    $result = DB::table('users')
                // ->inRandomOrder()
                ->orderByRaw('RAND()')
                ->first();

    //So this query allows me to get all the comments with five star rating only.
    $result = DB::table('comments')
                ->selectRaw('count(id) as number_of_5stars_comments, rating')//So this query allows me to get all the comments with five star rating only.
                ->groupBy('rating')
                ->having('rating', '=', 5)//similiar to where but in aggreate column
                ->get();

    $result = DB::table('comments')
                ->skip(5)//skip the first 5 
                ->take(5)//take the last 5
                ->get();

    $result = DB::table('comments')
                ->offset(5)//skip the first 5
                ->limit(5)//take the last 5
                ->get();

    dump($result);

    return view('welcome');
});

