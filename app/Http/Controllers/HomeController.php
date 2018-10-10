<?php

namespace App\Http\Controllers;

use App\Complaints;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function complaintsStatus()
    {

        $openComplaints = DB::table('complaints')
            ->where('complstatus_id', '=', 1)->count();

        $pendingComplaints = DB::table('complaints')
            ->where('complstatus_id', '=', 2)->count();

        $closedComplaints = DB::table('complaints')
            ->where('complstatus_id', '=', 3)->count();
        $data= ['open'=>$openComplaints,'pending'=>$pendingComplaints,'closed'=>$closedComplaints];
        return response()->json($data,'200',['json']);
    }

}
