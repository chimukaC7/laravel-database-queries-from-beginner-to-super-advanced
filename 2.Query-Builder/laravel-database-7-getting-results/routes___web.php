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

    // $users = DB::table('users')->get();//returns all the colunms and values
    //when there is no select it means that we want to fetch all the columns from the table

    // $users = DB::table('users')->pluck('email');//returns values under the email column

    // $user = DB::table('users')->where('name', 'Mrs. Odie Metz')->first();//returns only one result

    // $user = DB::table('users')->where('name', 'Mrs. Odie Metz')->value('email');//works like pluck

    // $user = DB::table('users')->find(1);//used to find a record by id 


    // $comments= DB::table('comments')->select('content as comment_content')->get();
    //when you provide a select method to the query,you can list only those columns that you want to fetch
    //changing the name of the printed column

    // $comments= DB::table('comments')->select('user_id')->distinct()->get();
    //get all the records from the comments table but only user_id column values but don't repeat the user_id

    // $result = DB::table('comments')->count();

    // $result = DB::table('comments')->max('user_id');

    // $result = DB::table('comments')->sum('user_id');
    // min, avg

    // $result = DB::table('comments')->where('content', 'content')->exists();
    
    $result = DB::table('comments')->where('content', 'content')->doesntExist();

    dump($result);

    return view('welcome');
});

