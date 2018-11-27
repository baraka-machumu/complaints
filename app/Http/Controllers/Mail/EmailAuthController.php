<?php

namespace App\Http\Controllers\Mail;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class EmailAuthController extends Controller
{

    public function create($token){


        return view('mail.auth',compact('token'));

    }

    public function  store(Request $request, $token){


        $password = bcrypt($request->get('password'));
        $user = DB::table('users')
            ->where('remember_token',$token)
            ->update(['password'=>$password]);



        if ($user)
        {
            Session::flash('alert-success', 'Password Succesful changed,please login');

        } else {
            Session::flash('alert-warning', 'Failed to change password ,try again');
        }
        return redirect('login');

    }
}
