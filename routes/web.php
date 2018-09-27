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

    $user_id = 12;
    $user_profile  = DB::table('user_profiles')
        ->join('profiles', 'user_profiles.profile_id', '=', 'profiles.id')
        ->select('profiles.profile_name')
        ->where('user_profiles.user_id','=',$user_id)
    ->get();

    return $user_profile;
});

Route::get('user/register','Admin\UserController@create');
Route::get('user/edit','Admin\UserController@create');
Route::get('user/delete','Admin\UserController@create');

Route::resource('user','Admin\UserController');

Route::post('user/update','Admin\UserController@updates');


//profile
Route::get('profile/create','Admin\ProfileController@create');
Route::get('profile/edit','Admin\ProfileController@edit');
Route::get('profile/delete','Admin\ProfileController@create');

Route::resource('profile','Admin\ProfileController');

Route::post('profile/update','Admin\ProfileController@updates');


//user profile
Route::get('userProfile/create','Admin\UserProfileController@create');
Route::get('userProfile/edit','Admin\UserProfileController@edit');
Route::get('userProfile/delete','Admin\UserProfileController@create');

Route::get('userProfile/assign/profile/{id}','Admin\UserProfileController@assignProfile');

Route::resource('userProfile','Admin\UserProfileController');

Route::post('userProfile/update','Admin\UserProfileController@updates');


