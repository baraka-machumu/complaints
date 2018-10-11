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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

Route::get('/test', function () {

    $data_wcf= (object) DB::select(" SELECT COUNT(complaint_status_name) AS wcf FROM vw_complaints WHERE scheme_name LIKE 'wcf%' AND complaint_status_name LIKE 'open%' UNION
SELECT COUNT(complaint_status_name) AS wcf FROM vw_complaints WHERE scheme_name LIKE 'wcf%' AND complaint_status_name LIKE 'closed%' UNION
SELECT COUNT(complaint_status_name) AS wcf FROM vw_complaints WHERE scheme_name LIKE 'wcf%' AND complaint_status_name LIKE 'pending%' UNION
SELECT COUNT(complaint_status_name) AS wcf FROM vw_complaints WHERE scheme_name LIKE 'wcf%'
" );

    $dataarray = [];
    foreach ($data_wcf as $data){
        array_push($dataarray,$data->wcf);
    }

    return response()->json($dataarray)->header('content-type','json');


});


Route::get('api/json/all/complaints/open','HomeController@getJsonOPenComplaintsPerMonth');
Route::get('api/json/all/complaints/pending','HomeController@getJsonPendingComplaintsPerMonth');
Route::get('api/json/all/complaints/closed','HomeController@getJsonClosedComplaintsPerMonth');


Route::get('api/json/all/complaints/piechart','HomeController@getJsonAllComplaintsPiechart');

// get default url
Route::get('/','Auth\LoginController@index');

Route::get('logout', 'Auth\LoginController@logout');

Auth::routes();
Route::get('api/complaints/count', 'HomeController@complaintsStatus');
Route::get('/home', 'HomeController@index')->name('home');

//Complaints Controller
Route::get('create','Complaints\ComplaintsController@create');
Route::resource('complaints','Complaints\ComplaintsController');


//Complaints type Controller
Route::resource('complaints-types','Complaints\ComplaintsTypeController');
Route::post('complaints-types/update','Complaints\ComplaintsTypeController@updates');


//Scheme type Controller
Route::resource('scheme-types','Scheme\SchemeTypeController');
Route::post('scheme-types/update','Scheme\SchemeTypeController@updates');


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



