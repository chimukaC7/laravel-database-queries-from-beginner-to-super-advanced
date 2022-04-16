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

    $result = DB::table('rooms')
                ->sharedLock() // If you query for something and later want to update/insert related data (within transaction). Other sessions can read, but cannot  modify
                ->find(1);

    $result = DB::table('rooms')
                ->where('room_size',3)
                ->lockForUpdate() //  Other sessions cannot read, cannot  modify
                ->get()
                // ->dd()
                // ->dump()
                ;

    dump($result);

    return view('welcome');
});
