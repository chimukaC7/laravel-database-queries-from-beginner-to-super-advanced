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

    //when it comes to search text type column
    //But when it comes to searching through text the column type in the database like this, for example,
    //the content of the comment, it's text type.
    //It is a better choice to use full text index instead of just using a LIKE sql operator.
    //Because using full text index searching, using full text index is faster than using like a sql operator.
    //Let's create such index on the comments table.
    $result = DB::statement('ALTER TABLE comments ADD FULLTEXT fulltext_index(content)'); // MySQL >= 5.6
    $result = DB::table('comments')
        ->whereRaw("MATCH(content) AGAINST(? IN BOOLEAN MODE)", ['inventore'])
        //->whereRaw("MATCH(content) AGAINST(? IN BOOLEAN MODE)", ['+inventore -pariatu'])
        ->get();
        //default mode is natural language mode, boolean mode is more powerful because we can specify additional parameters to the bounded value.
        //it doesn't have to be only one string. It can be as many words as we want, Separated by spaces and boolean mode allows me to precede each of these words by, for example, plus sign or minus sign
        //plus sign means that the word has to be in the content column 
        //minus sign means that searched keyword must not exist in content column.

    $result = DB::table('comments')
    ->where("content", 'like', '%inventore%')
    ->get();

    dump($result);

    return view('welcome');
});

