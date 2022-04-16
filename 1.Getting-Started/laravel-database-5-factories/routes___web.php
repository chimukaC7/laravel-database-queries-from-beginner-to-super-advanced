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

    $users = DB::table('users')->get();
    $comments = DB::table('comments')->get();

    // dump(factory(App\Comment::class,3)->make());
    // dump(factory(App\Comment::class,3)->create());

    dump($users, $comments);

    return view('welcome');
});

