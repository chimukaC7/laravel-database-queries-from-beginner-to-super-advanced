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

    DB::table('rooms')->insert([
        ['room_number' => 1, 'room_size' => 1, 'price' =>1, 'description' => 'new description 1'],
        ['room_number' => 2, 'room_size' => 2, 'price' =>2, 'description' => 'new description 2']
    ]);

    $id = DB::table('rooms')->insertGetId(//going to insert one record and return the id
        ['room_number' => 3, 'room_size' => 3, 'price' =>3, 'description' => 'new description 3'],
    );

    $result = DB::table('rooms')
                ->get();

    dump($result, $id);

    return view('welcome');
});
