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
use Illuminate\Support\Facades\Storage;

class ResponseController extends Controller
{
    public function attend($complaint_id, $actions){

        $controller  = new ComplaintsController();
        $complainer_details = $controller->complainerDetail($complaint_id);

        $response_model =  new ResponseType();
        $response_type =  $response_model->responseType();

        $complaint_type_controller =  new ComplaintsTypeController();
        $complaint_type =$complaint_type_controller->getAllComplaintsType();

        return view('response.attend',compact('actions','complainer_details','response_type','complaint_type','complaint_id'));

    }

    public function storeResponse(Request $request,$complaint_id, $actions)
    {
        $response  =  new Response();

        $response->responsetype_id =  $request->get('response_type');
        $response->complaint_id =  $complaint_id;
        $response->resp =  $request->get('reponse_details');
        $response->date_response = Carbon::now();

        $files = $request->file('letters');

        $success =  $response->save();
        $update_complaint_status = DB::statement('call update_complaint_status(?,?)',array($complaint_id, $actions));

        if ($success &&$update_complaint_status) {
            if (!empty($files)) {

                foreach ($files as $file) {
                    $letter = new Letter();

                    $filename = $file->getClientOriginalName();
                    Storage::disk('local')->put('public/latter/' . $filename, 'content');

                    $letter->complaint_id = $complaint_id;
                    $letter->letter_link = $filename;

                    $letter->save();

                }
            }
                Session::flash('alert-success', 'Response successful  added');

        }
        else {
            Session::flash('alert-warning', 'Failed');

        }
        return redirect('response/attend/'.$complaint_id.'/'.$actions);

    }
}
