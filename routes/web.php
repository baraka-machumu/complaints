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

    $roleProfiles = DB::table('role_profiles')
        ->join('roles', 'role_profiles.role_id', '=', 'roles.id')
        ->select('roles.role_name','role_profiles.id')
        ->where('role_profiles.profile_id', '=', 3)
        ->get();
    return $roleProfiles;
});

//user route
Route::get('user/register','Admin\UserController@create');
Route::resource('user','Admin\UserController');

//Role route
Route::get('role/All','Admin\RoleController@getAllRole');
Route::resource('role','Admin\RoleController');
Route::post('role/update','Admin\RoleController@updates');

//Role Profile
Route::get('roleProfile/assign/role/{id}','Admin\RoleProfileController@assignRole');
Route::resource('roleProfile','Admin\RoleProfileController');
Route::post('user/login','UserController@store');

