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
            ->whereBetween('room_size',[1,3]) // whereNotBetween
            ->get();

    $result = DB::table('rooms')
            ->whereNotIn('id',[1,2,3]) // whereIn
            ->get();

    //whereNull('column')  //whereNotNull('column')
    //whereDate('created_at', '2020-05-13')
    //whereMonth('created_at', '5')
    //whereDay('created_at', '13')
    //whereYear('created_at', '2020')
    //whereTime('created_at', '=', '12:25:10')
    //whereColumn('column1', '>', 'column2')
    whereColumn([
        ['first_name', '=', 'last_name'],
        ['updated_at', '>', 'created_at']
    ]);

    $result = DB::table('users')
           ->whereExists(function ($query) {
               $query->select('id')
                     ->from('reservations')
                     ->whereRaw('reservations.user_id = users.id')
                     ->where('check_in', '=', '2020-05-12')//query builder
                     ->limit(1);
           })
           ->get();
           //fetch all users where in the reservations table exists user id value and check in value 
           //looking for users who made reservations check is equal to a date

    dump($result);

    return view('welcome');
});

