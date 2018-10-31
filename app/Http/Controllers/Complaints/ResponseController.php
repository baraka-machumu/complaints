<?php

namespace App\Http\Controllers\Complaints;

use App\Complaint;
use App\ComplaintType;
use App\Letter;
use App\MembershipStatus;
use App\Response;
use App\ResponseType;
use App\Scheme;
use Carbon\Carbon;
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

        return view('response.attend',compact('complainer_details','response_type','complaint_type','complaint_id'));

    }

    public function storeResponse(Request $request,$complaint_id)
    {

        $response  =  new Response();
        $letter  = new Letter();

        $response->responsetype_id =  $request->get('response_type');
        $response->complaint_id =  $complaint_id;
        $response->resp =  $request->get('reponse_details');
        $response->response_date = Carbon::now();


         dd($request->get('letters'));

        $success =  $response->save();







    }





}
