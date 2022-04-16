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

    // $affected = DB::table('rooms')
    //           ->where('id', 1)
    //           ->update(['price' => 222]);


    // $affected = DB::table('users')
    //           ->where('id', 1)
    //           ->update(['meta->settings->site_language' => 'es']);

    // $affected = DB::table('rooms')->increment('price', 20);
    $affected = DB::table('rooms')->decrement('price', 10, ['description' => 'new description']);

    $result = DB::table('rooms')
                ->get();

    dump($result, $affected);

    return view('welcome');
});
