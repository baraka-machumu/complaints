<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userData  = $this->getAllUsers();
        return view('user.user_registration',with(['userData'=>$userData]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user  =  new User();
        $username = $request->get('username');
        $email =  $request->get('email');
        $password  =  $this->passwordGenerator();

        $user->name  =  $username;
        $user->email = $email;
        $user->password = $password;

        $success =  $user->save();

        if ($success)
        {
            Session::flash('alert-success', 'successful Registered');

        } else {
            Session::flash('alert-warning', 'Registration Failed');

        }

         $userData  = $this->getAllUsers();

        return redirect('user/register');

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

        return view('user.edit',compact(['id'=>$id]));
    }


    public function updates(Request $request)
    {

        $id  =  $request->get('user_id');

        $user =  User::find($id);

        $user->name  =  $request->get('username');
        $user->email =  $request->get('email');

        $success = $user->save();


        if ($success)
        {
            Session::flash('alert-success', 'successful Updated');

        } else {
            Session::flash('alert-warning', 'Failed to update, try again');

        }

        return redirect('user/register');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user =  User::find($id);

        $user->status =  0;

        $success = $user->save();


        if ($success)
        {
            Session::flash('alert-success', 'successful Updated');

        } else {
            Session::flash('alert-warning', 'Failed to update, try again');

        }

        return redirect('user/register');


    }



    // generate default password

    public function  passwordGenerator(){

        $prefix = "ssra";
        $date = Carbon::now();
        $date  =substr($date,0,4);
        return bcrypt($prefix.".".$date);
    }

    public function getLastInsertedData()
    {
        $user =  User::orderBy('id', 'desc')->first();

        return $user;
    }

    public function getAllUsers()
    {
        $user =  DB::table('users')->where('status', '1')->get()->toArray();

        return $user;
    }

}
