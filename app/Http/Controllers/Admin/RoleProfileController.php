<?php

namespace App\Http\Controllers\Admin;

use App\Profile;
use App\Role;
use App\Roleprofile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class RoleProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = Profile::all()->toArray();
        return view('roleProfile.index',with(['profiles'=>$profiles]));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role_names = $request->get('role_name');
        $roleProfile = new RoleProfile();
        $profileId =  $request->get('profile_id');
        for ($i=0; $i<sizeof($role_names); $i++)
        {
            $roleProfile->role_id = $role_names[$i];
            $roleProfile->profile_id = $profileId;
        }
        $success= $roleProfile->save();

        if ($success)
        {
            Session::flash('alert-success', 'successful Registered');

        } else {
            Session::flash('alert-warning', 'Registration Failed');
        }

        return redirect('roleProfile/assign/role/'.$profileId);

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profile_id = Session::get('profile_id');
        $deleteAssignedRole = RoleProfile::find($id);
        $success = $deleteAssignedRole->delete();
        if ($success)
        {
            Session::flash('alert-success', 'successful Role deleted');

        } else {
            Session::flash('alert-warning', 'Failed to delete Role');
        }
        return redirect('roleProfile/assign/role/'.$profile_id);
    }

    public function assignRole($id)
    {
        Session::put('profile_id',$id);
        $roles = Role::all()->toArray();
        $profile = Profile::find($id);
        $profilename = $profile['profile_name'];

        $assignedRoles = $this->getRoleProfile($id);

        return view('roleProfile.assignRole',with(['id'=>$id,'roles'=>$roles, 'profilename'=>$profilename,
            'assignedRoles'=>$assignedRoles]));

    }

    public function getRoleProfile($profile_id)
    {
        $roleProfiles = DB::table('role_profiles')
            ->join('roles', 'role_profiles.role_id', '=', 'roles.id')
            ->select('roles.role_name','role_profiles.id')
            ->where('role_profiles.profile_id', '=', $profile_id)
            ->get();
        return $roleProfiles;
    }
}
