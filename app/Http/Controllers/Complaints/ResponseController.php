<?php

namespace App\Http\Controllers\Complaints;

use App\Complainer;
use App\Complaint;
use App\ComplaintType;
use App\Http\Controllers\Mail\MailController;
use App\Letter;
use App\MembershipStatus;
use App\Response;
use App\ResponseType;
use App\Scheme;
use App\SMS\SmsController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ResponseController extends Controller
{
    public function __construct()
    {
        $this->middleware('user');
        $this->middleware('admin');
        $this->middleware('auth');

    }



    public function attend($complaint_id,$actions){

        $controller  = new ComplaintsController();
        $complainer_details = $controller->complainerDetail($complaint_id);

        $response_model =  new ResponseType();
        $response_type =  $response_model->responseType();

        $complaint_type_controller =  new ComplaintsTypeController();
        $complaint_type =$complaint_type_controller->getAllComplaintsType();

        return view('response.attend',compact('actions','complainer_details','response_type','complaint_type','complaint_id'));

    }

    public function storeResponse(Request $request,$complaint_id,$actions)
    {
        $complaint = DB::table('vw_complaints')
            ->select('complaint_id')
            ->where('complaint_id',$complaint_id)
            ->first();
        $complainers = Complainer::complainerDetail($complaint->complaint_id);

        $refno= $complainers->refno;
//        dd($refno);
        $phone_number =$complainers->phone;

        $firstname = $complainers->firstname;
        $surname = $complainers->surname;

        $response  =  new Response();

        $response->responsetype_id =  $request->get('response_type');
        $response->complaint_id =  $complaint->complaint_id;
        $response->resp =  $request->get('reponse_details');
        $response->date_response = Carbon::now();
        $response->user_id = Auth::user()->id;

        $success =  $response->save();


//          $mail = MailController::sendMail();
        $message= "Ndugu ".$firstname ."  ".$surname.",  Kufuatilia lalamiko lako, tuma ".$refno." kwenda namba 0762440706 au ingiza namba hiyo kwenye mfumo wetu ya malalamiko";
//        $send_sms = SmsController::sendSms($message,$phone_number,'SSRA');
        $update_complaint_status =   DB::statement('call update_complaint_status(?,?)',array($complaint_id,$actions));

        if ($success && $update_complaint_status){

            $files = $request->file('letters');

            if (!empty($files)){

                foreach ($files as $file){

                    $letter  = new Letter();
                    $extension = $file->getClientOriginalExtension();

                    $name  =  $file->getClientOriginalName();

                    dd($name);
                    
                    $filename = $file. $extension;

                    $file->move(
                        base_path().'/public/letter', $filename
                    );
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
