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

    $fullsearch = "2014-06-12";
    $search =  DB::table('complaints')
        ->join('complainer','complaints.complainer_id','=','complainer.complainer_id')
        ->join('schemes','schemes.scheme_id','=','complainer.scheme_id')
        ->join('complaint_status','complaint_status.complaint_status_id','=','complaints.complaint_status_id')
        ->where(
            DB::raw('concat(complainer.firstname," ",complainer.surname)') ,'LIKE' , '%'.$fullsearch.'%')
        ->orwhere('complainer.residence'  ,'LIKE' , '%'.$fullsearch.'%')
        ->orwhere('complainer.ssno'  ,'LIKE' , '%'.$fullsearch.'%')
        ->orwhere('complainer.email'  ,'LIKE' , '%'.$fullsearch.'%')
        ->orwhere('complaints.date_complaint'  ,'LIKE' , '%'.$fullsearch.'%')
        ->get();
    return $search;
});


Route::get('api/json/all/complaints/open','HomeController@getJsonOPenComplaintsPerMonth');
Route::get('api/json/all/complaints/pending','HomeController@getJsonPendingComplaintsPerMonth');
Route::get('api/json/all/complaints/closed','HomeController@getJsonClosedComplaintsPerMonth');
Route::get('api/json/summary/byscheme','HomeController@summaryBySchemeApi');






Route::get('api/json/all/complaints/piechart','HomeController@getJsonAllComplaintsPiechart');

// get default url
Route::get('/','Auth\LoginController@index');

Route::get('logout', 'Auth\LoginController@logout');

Auth::routes();
Route::get('api/complaints/count', 'HomeController@complaintsStatus');
Route::get('/dashboard', 'HomeController@index')->name('dashboard');

//Complaints Controller
Route::get('complaint/tab','Complaints\ComplaintsController@complaintTab');
Route::get('create','Complaints\ComplaintsController@create');
Route::get('complaints/tab','Complaints\ComplaintsController@complaintTab');
Route::get('api/complaints/opening/all','Complaints\ComplaintsController@complaintOpening');
Route::get('api/complaints/editing/all','Complaints\ComplaintsController@complaintEditing');
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

//Search Controller
Route::get('search/form', 'SearchController@create');
Route::get('api/search', 'SearchController@apiSearch');



