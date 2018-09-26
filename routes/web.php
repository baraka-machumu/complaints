<?php

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

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {

    $user =  User::orderBy('id', 'desc')->first();

    return $user;
});

Route::get('user/register','Admin\UserController@create');
Route::resource('user','Admin\UserController');

Route::post('user/login','UserController@store');

