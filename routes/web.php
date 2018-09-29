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
    $roleProfiles = DB::table('role_profiles')
        ->join('roles', 'role_profiles.role_id', '=', 'roles.id')
        ->select('roles.role_name','role_profiles.id')
        ->where('role_profiles.profile_id', '=', 3)
        ->get();
    return $roleProfiles;
});

//Complaints Controller
Route::resource('complaints','Complaints\ComplaintsController');

//Complaints type Controller
Route::resource('complaints-types','Complaints\ComplaintsTypeController');


//user route
Route::get('user/register','Admin\UserController@create');
Route::get('user/edit','Admin\UserController@create');
Route::get('user/delete','Admin\UserController@create');

Route::resource('user','Admin\UserController');

//Role route
Route::get('role/All','Admin\RoleController@getAllRole');
Route::resource('role','Admin\RoleController');
Route::post('role/update','Admin\RoleController@updates');

//Role Profile
Route::get('roleProfile/assign/role/{id}','Admin\RoleProfileController@assignRole');
Route::resource('roleProfile','Admin\RoleProfileController');
Route::post('user/login','UserController@store');
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




