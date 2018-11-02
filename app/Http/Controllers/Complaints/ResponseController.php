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



    public function attend($complaint_id,$actions){

        $controller  = new ComplaintsController();
        $complainer_details = $controller->complainerDetail($complaint_id);

        $response_model =  new ResponseType();
        $response_type =  $response_model->responseType();

        $complaint_type_controller =  new ComplaintsTypeController();
        $complaint_type =$complaint_type_controller->getAllComplaintsType();

        return view('response.attend',compact('complainer_details','response_type','complaint_type','complaint_id'));

    }

    public function storeResponse(Request $request,$complaint_id,$actions)
    {

        $response  =  new Response();


        $response->responsetype_id =  $request->get('response_type');
        $response->complaint_id =  $complaint_id;
        $response->resp =  $request->get('reponse_details');
        $response->date_response = Carbon::now();

        $success =  $response->save();



        $update_complaint_status =   DB::statement('call update_complaint_status(?,?)',array($complaint_id,$actions));


        if ($success && $update_complaint_status){

            $files = $request->file('letters');

            if (!empty($files)){

                foreach ($files as $file){

                    $letter  = new Letter();

                    $filename = $file->getClientOriginalName();

                    Storage::disk('local')->put('public/letter/'.$filename, 'Contents');

                    $letter->complaint_id = $complaint_id;
                    $letter->letter_link = $filename;

                    $letter->save();

                }

            }

                Session::flash('alert-success', 'Response was successful saved');

        } else {

            Session::flash('alert-warning', 'Failed to save Response try again');

        }

        return redirect('response/attend/'.$complaint_id.'/'.$actions);

    }


}
