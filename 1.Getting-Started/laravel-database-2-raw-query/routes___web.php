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

    // $pdo = DB::connection(/*'sqlite'*/)->getPdo();
    // $users = $pdo->query('select * from users')->fetchAll();

    // RAW QUERIES
    // $result = DB::select('select * from users where id = ? and name = ?', [1, 'Adalberto Gerlach']);
    // $result = DB::select('select * from users where id = :id', ['id' => 1]);

    // DB::insert('insert into users (name, email,password) values (?, ?, ?)', ['Inserted Name', 'email@fdf.fd','passw']);

    // $affected = DB::update('update users set email = "updatedemail@email.com" where email = ?', ['email@fdf.fd']);

    // $deleted = DB::delete('delete from users where id = ?',[4]);

    // DB::statement('truncate table users');

    // $result = DB::select('select * from users');//returns an array
    //END OF RAW QUERIES

    //QUERY BUIDER 
    // $result = DB::table('users')->select()->get();//returns a collection which presents some benefits

    //ELOQUENT 
    $result = User::all();

    dump($result);

    return view('welcome');
});

