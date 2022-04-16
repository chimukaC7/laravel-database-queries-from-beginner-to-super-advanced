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

    //show database results using subpages
    return $result = DB::table('comments')->paginate(3); // other statements like where clause are also possible
    // simplePaginate(3);
    //so instead of get() that returns all of the records from the table, we can use paginate and the number of records that will fetch from the database
                
    dump($result->items());

    return view('welcome');
});

