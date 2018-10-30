<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Jaspersoft\Client\Client;

class ReportController extends Controller
{

    public  function selectReport(){


        $report_names =  DB::table('report_config')->select('id','report_name')->get();

        return view('reports.select_report',compact('report_names'));

    }

    public function  getReportNames(){

        $report_names =  DB::table('complaints')->select('id','report_name')->get();


    }


    public function getReport($id){

        $report_data =  DB::table('report_config')->select('*')->where('id','=',$id)->get();

        $server =  new Client('http://localhost:8080/jasperserver','jasperadmin','datajasper.2018');

        if ($report_data[0]->has_param==0){

            $report = $server->reportService()->runReport($report_data[0]->resource_url,'pdf');

            header('Content-Type: application/pdf');
            echo $report;
        }


        //set session for id

        Session::put('id',$id);
        return view('reports.params',compact('report_data','id'));

    }


    public  function  paramReport(Request $request){

        $id = Session::get('id');
        $report_data =  DB::table('report_config')->select('resource_url')->where('id','=',$id)->get();

        $input_controls =  $request->get('data');

        $server =  new Client('http://localhost:8080/jasperserver','jasperadmin','datajasper.2018');

        $report = $server->reportService()->runReport($report_data[0]->resource_url,'pdf',null,null,$input_controls);
        header('Content-Type: application/pdf');

        echo $report;
    }

}
