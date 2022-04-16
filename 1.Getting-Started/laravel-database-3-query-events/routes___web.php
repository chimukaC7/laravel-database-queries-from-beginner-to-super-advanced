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

    $result = DB::table('users')->select()->get();

    //transaction are used to prevent data inconsistence
    //when two tables need to be updated once
    //transaction should be rolled back if one of the transactions fails
    DB::transaction(function () {
        // try catch block is not necessary as well as DB::rollBack();
        try {
            DB::table('users')->delete();
            $result = DB::table('users')->where('id',4)->update(['email' => 'none']);
            if(!$result)
            {
                throw new \Exception;
            }
        } catch(\Exception $e) {
            DB::rollBack();//incase of an exception rollback the transaction
        }
  
    }, 5); // optional third argument, how many times a transaction should be reattempted


    dump($result);

    return view('welcome');
});

