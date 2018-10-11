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


    public  function complaintsBySchemePpf()
    {
        $data_ppf= (object) DB::select(" SELECT COUNT(complaint_status_name) AS ppf FROM vw_complaints WHERE scheme_name LIKE 'PPF%' AND complaint_status_name LIKE 'open%' UNION
SELECT COUNT(complaint_status_name) AS ppf FROM vw_complaints WHERE scheme_name LIKE 'PPF%' AND complaint_status_name LIKE 'closed%' UNION
SELECT COUNT(complaint_status_name) AS ppf FROM vw_complaints WHERE scheme_name LIKE 'PPF%' AND complaint_status_name LIKE 'pending%' UNION
SELECT COUNT(complaint_status_name) AS ppf FROM vw_complaints WHERE scheme_name LIKE 'PPF%'
" );

        $dataarray = [];
        foreach ($data_ppf as $data){
            array_push($dataarray,$data->ppf);
        }

        return response()->json($dataarray)->header('content-type','json');

    }


    public  function complaintsBySchemePspf()
    {
        $data_Pspf= (object) DB::select(" SELECT COUNT(complaint_status_name) AS Pspf FROM vw_complaints WHERE scheme_name LIKE 'Pspf%' AND complaint_status_name LIKE 'open%' UNION
SELECT COUNT(complaint_status_name) AS Pspf FROM vw_complaints WHERE scheme_name LIKE 'Pspf%' AND complaint_status_name LIKE 'closed%' UNION
SELECT COUNT(complaint_status_name) AS Pspf FROM vw_complaints WHERE scheme_name LIKE 'Pspf%' AND complaint_status_name LIKE 'pending%' UNION
SELECT COUNT(complaint_status_name) AS Pspf FROM vw_complaints WHERE scheme_name LIKE 'Pspf%'
" );

        $dataarray = [];
        foreach ($data_Pspf as $data){
            array_push($dataarray,$data->Pspf);
        }

        return response()->json($dataarray)->header('content-type','json');

    }


    public  function complaintsBySchemewcf()
    {
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

    }


}
