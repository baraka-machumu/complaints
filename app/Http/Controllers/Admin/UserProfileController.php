<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\UserProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userData = new UserController();
        $userData = $userData->getAllUsers();

        return view('user_profile.list_userProfile', with(['userData' => $userData]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $profiles_names  =  $request->get('profile_name');
        $userProfile =  new UserProfile();
        $user_id = $request->get('user_id');

      for ($i=0; $i<sizeof($profiles_names); $i++){

          $userProfile->profile_id = $profiles_names[$i];
          $userProfile->user_id =$user_id;
          $userProfile->save();
      }

        $success=  $userProfile->save();

        if ($success)
        {
            Session::flash('alert-success', 'successful Updated');

        } else {
            Session::flash('alert-warning', 'Failed to update, try again');

        }


        return redirect('userProfile/assign/profile/'.$user_id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $profile =  UserProfile::find($id);
//        dd($profile);

        $success = $profile->delete();

        $user_id =  Session::get('user_id');


        if ($success)
        {
            Session::flash('alert-success', 'successful Deleted');

        } else {
            Session::flash('alert-warning', 'Failed to update, try again');

        }

        return redirect('userProfile/assign/profile/'.$user_id);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function assignProfile($id){

        Session::put('user_id', $id);


        $profile =  new ProfileController();
        $profiles =  $profile->getAllProfile();

        $assigned_profiles=  $this->getUserProfile($id);

        $user =  User::find($id);
        $username  =  $user['name'];

        $_SESSION['user_id'] =  $id;

        return view('user_profile.assign_userProfile',with(['id'=>$id,'profiles'=>$profiles,'username'=>$username,'assigned_profiles'=>$assigned_profiles]));

    }

    public  function  getUserProfile($user_id){

        $user_profile  = DB::table('user_profiles')
            ->join('profiles', 'user_profiles.profile_id', '=', 'profiles.id')
            ->select('profiles.profile_name','user_profiles.id')
            ->where('user_profiles.user_id','=',$user_id)
            ->get();

        return $user_profile;
    }



}








