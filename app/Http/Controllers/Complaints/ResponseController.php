<?php

namespace App\Http\Controllers\Complaints;

use App\Complaint;
use App\ComplaintType;
use App\MembershipStatus;
use App\ResponseType;
use App\Scheme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ResponseController extends Controller
{



    public function attend($complaint_id){

        $controller  = new ComplaintsController();
        $complainer_details = $controller->complainerDetail($complaint_id);

        $response_model =  new ResponseType();
        $response_type =  $response_model->responseType();

        $complaint_type_controller =  new ComplaintsTypeController();
        $complaint_type =$complaint_type_controller->getAllComplaintsType();

        return view('response.attend',compact('complainer_details','response_type','complaint_type'));

    }

    public function editComplaints($complaint_id){

        $edit_complaints =(array)DB::table('vw_complaints')
            ->select('*')
            ->where('complaint_id', '=', $complaint_id)
            ->first();
        return view('response.edit_complaints',compact('edit_complaints','complaint_id'));

    }



}
