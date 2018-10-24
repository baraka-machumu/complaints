<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Jaspersoft\Client\Client;

class ReportController extends Controller
{

    public  function select(){

        return view('reports.select_report');

    }


    public  function category(){

        $controls = array(
            'start_date'=>'2014-07-01',
            'end_date'=>'2018-10-01'

        );

     $server =  new Client('http://localhost:8080/jasperserver','jasperadmin','datajasper.2018');

     $repository = $server->reportService()->runReport('/reports/no_of_categort_by_date','pdf', null, null, $controls);
     header('Content-Type: application/pdf');
     echo $repository;
    }

}
