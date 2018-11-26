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
        $complaint = DB::table('complaints')
            ->select('complaint_id')
            ->where('refno',$refno)
            ->first();

        if (empty($complaint))
        {
            Session::flash('alert-warning', 'No data found for your search');

            return redirect('complaints/followups');
        }

        $complainer = Complainer::complainerDetail($complaint->complaint_id);
        $letter = Letter::letterDetail($complaint->complaint_id);


        $responses = Response::responseDetail($complaint->complaint_id);

        return view('followup.result', compact('letter', 'responses', 'complainer'));

    }

}
