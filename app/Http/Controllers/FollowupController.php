<?php

namespace App\Http\Controllers;

use App\Complainer;
use App\Complaint;
use App\ComplaintType;
use App\Http\Controllers\Complaints\ComplaintsController;
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

class FollowupController extends Controller
{
    public function followup()
    {
        return view('followup.create');
    }

    public function searchfollowup(Request $request)
    {
        $refno= $request->get('search');
        $complaint_id = DB::table('complaints')
            ->select('complaint_id')
            ->where('refno',$refno)
            ->first();

        $complainer = Complainer::complainerDetail($complaint_id->complaint_id);
        $letter = Letter::letterDetail($complaint_id->complaint_id);


        $responses = Response::responseDetail($complaint_id->complaint_id);


        return view('followup.result', compact('letter', 'responses', 'complainer'));

    }

}
