<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

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
        $userData = "";
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

         $userData  = $this->getLastInsertedData();

        return view('user.user_registration',with(['userData'=>$userData]));

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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
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
        //
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
}
