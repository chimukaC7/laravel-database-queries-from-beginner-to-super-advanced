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

    DB::table('rooms')->where('id', '>', 10)->delete();

    DB::table('rooms')->delete();

    DB::table('rooms')->insert(['room_number'=>1, 'room_size'=>2, 'price'=>100, 'description'=>'desc']);
    
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');

    DB::table('rooms')->truncate();//id numbering will be resetted

    DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    $result = DB::table('rooms')
                ->get();

    dump($result);

    return view('welcome');
});
