<?php

namespace App\Http\Controllers\Complaints;

use App\Complainer;
use App\Complaint;
use App\ComplaintType;
use App\Http\Controllers\Mail\MailController;
use App\MembershipStatus;
use App\ReceiveModes;
use App\ReceiveMode;
use App\Scheme;
use App\SMS\SmsController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;


class ComplaintsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('complaints.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rec_modes = ReceiveMode::all()->toArray();
        $membership_status = MembershipStatus::all()->toArray();
        $all_scheme_types = Scheme::all()->toArray();
        $complaintsTypes = ComplaintType::all()->toArray();
        return view('complaints.create', with(['all_scheme_types'=>$all_scheme_types,'complaintsTypes'=>$complaintsTypes
            ,'membership_status'=>$membership_status,'rec_modes'=>$rec_modes]));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $complainer = new Complainer();

        $complaint = new Complaint();

        $phone_number =  substr($request->get('phone'),1,9);

        $phone_number = '+255'.$phone_number;

        $complainer->firstname = $request->get('first_name');
        $complainer->surname = $request->get('surname');
        $complainer->middlename = $request->get('middle_name');
        $complainer->postal = $request->get('postal');
        $complainer->residence = $request->get('residence');
        $complainer->phone = $phone_number;
        $complainer->email = $request->get('email');
        $complainer->ssinfo_id = $request->get('ssinfo_id');
        $complainer->scheme_id = $request->get('scheme_id');
        $complainer->ssno = $request->get('ssno');
        $complainer->employer = $request->get('employer');

        $success = $complainer->save();

        if ($success) {
            $refno = "S" .$complainer->complainer_id. "A";
            $complaint->complainer_id = $complainer->complainer_id;
            $complaint->complaint_type_id = $request->get('complaint_type_id');
            $complaint->complaint = $request->get('complaint');
            $complaint->date_complaint = Carbon::now();
            $complaint->refno = $refno;
            $complaint->complaint_rec_mode_id = $request->get('complaint_rec_mode_id');

            $complaint->save();

            $message= "Ndugu ".$complainer->firstname ."  ".$complainer->surname.",  Kufuatilia lalamiko lako, tuma ".$refno." kwenda namba 0762440706 au ingiza namba hiyo kwenye mfumo wetu ya malalamiko";

            $send_sms = SmsController::sendSms($message,$phone_number,'SSRA');

            Session::flash('alert-success', 'complaint successful  registered  and sms sent');


        } else {
            Session::flash('alert-warning', 'Failed to register complaint');
        }

        return  redirect('complaints/create');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $complainer =  $this->complainerDetail($id);
        $responses =  $this->responseDetail($id);
        return view('complaints.showComplaints', compact('responses','complainer'));
//        $data = $this->openComplaints($id);
//        $complaint_open_show =[];
//
//        foreach ($data as $data_show){
//
//            array_push($complaint_open_show,$data_show);
//        }
//
//        return view('complaints.showOpenComplaints');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $complaint_types = ComplaintType::all()->toArray();
        $schemes = Scheme::all()->toArray();
        $data = $this->editComplaintsDetails($id);

        $complaint_edit =[];

        foreach ($data as $data_edit){

            array_push($complaint_edit,$data_edit);
        }
        return view('complaints.editcomplaints', compact('complaint_edit', 'complaint_types', 'schemes', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $complaint_edit = Complaint::find($id);
        $complaint_edit->complaint_type_id = $request->get('complaint_type_id');
//        dd($complaint_edit);
        $success = $complaint_edit->save();
        if ($success)
        {
            Session::flash('alert-success', 'successful Complaints updated');

        } else {
            Session::flash('alert-warning', 'Failed to update Complaints');

        }
        return redirect('complaints/tab');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function complaintTab()
    {
        $pending_complaints = $this->pendingComplaints();
        $open_complaints =$this->openComplaints();
        $edit_complaints = $this->editComplaints();
        $closed_complaints =  $this->closedComplaints();

        $actions = ['not_close'=>1,'close'=>2];

        return view('complaints.tab',compact('actions','open_complaints','edit_complaints', 'pending_complaints','closed_complaints'));

    }

    public function complaintEditing(Request $request)
    {
        $complaint_editing = $this->editComplaints();

        if ($request->ajax()){

            $editing_complaints_search= $this->editComplaintSearch($request->fullname);

            $table = "<table class='table table-bordered table-striped'><tr><th>Full name</th><th>Complaint</th><th>Complaint Type</th><th>Action</th></tr>";

            foreach ($editing_complaints_search as $editing){

                $fullname  = $editing->firstname.' '.$editing->surname;
                $complaint = substr($editing->complaint,0,100);
                $complaint_type  = $editing->complaint_type_name.' '.$editing->complaint_type_name;


                $table .= "<tr><td>$fullname</td>";
                $table .= "<td>$complaint</td>";
                $table .= "<td>$complaint_type</td>";
                $table .= "<td><a href='#'><span class='glyphicon glyphicon-edit'>Edit</span></a>";
            }

            $table .="</table>";

            return $table;

        }

        $table = "<table class='table table-bordered table-striped'><tr><th>Full name</th><th>Complaint</th><th>Complaint Type</th><th>Action</th></tr>";

        foreach ($complaint_editing as $editing){

            $fullname  = $editing->firstname.' '.$editing->surname;
            $complaint = substr($editing->complaint,0,100);
            $complaint_type  = $editing->complaint_type_name.' '.$editing->complaint_type_name;


            $table .= "<tr><td>$fullname</td>";
            $table .= "<td>$complaint</td>";
            $table .= "<td>$complaint_type</td>";
            $table .= "<td><a href='#'><span class='glyphicon glyphicon-edit'>edit</span></a>";
        }

        $table .="</table>";

        return $table;

    }


    public function  editComplaints(){

        $complaint_edit=  DB::table('complaints')
            ->join('complainer', 'complaints.complainer_id', '=', 'complainer.complainer_id')
            ->join('complaint_types', 'complaints.complaint_type_id', '=', 'complaint_types.complaint_type_id')
            ->where('complaints.complaint_status_id', '=', '1')
            ->get();
        return $complaint_edit;

    }

    public function  editComplaintsDetails($complaint_id){

        $complaint_edit=  DB::table('complaints')
            ->join('complainer', 'complaints.complainer_id', '=', 'complainer.complainer_id')
            ->join('complaint_types', 'complaints.complaint_type_id', '=', 'complaint_types.complaint_type_id')
            ->where
            ([
                ['complaints.complaint_status_id', '=', '1'],
                ['complaints.complaint_id', '=', $complaint_id]
            ] )
            ->get();
        return $complaint_edit;

    }

    public function editComplaintSearch($fullname)
    {
        $complaint_edit_search=  DB::table('complaints')
            ->join('complainer', 'complaints.complainer_id', '=', 'complainer.complainer_id')
            ->join('complaint_types', 'complaints.complaint_type_id', '=', 'complaint_types.complaint_type_id')
            ->where('complaints.complaint_status_id', '=', '1')
            ->where(DB::raw('concat(complainer.firstname," ",complainer.surname)') , 'LIKE' , '%'.$fullname.'%')
            ->paginate(10);
        return $complaint_edit_search;
    }

    public function  openComplaints(){

        $data_open =  DB::table('complaints')
            ->join('complainer','complaints.complainer_id','=','complainer.complainer_id')
            ->join('schemes','schemes.scheme_id','=','complainer.scheme_id')
            ->select('complainer.firstname','complainer.surname','complainer.surname','complaints.complaint','complaints.date_complaint','complaints.complaint_id')
            ->where('complaint_status_id','=','1')
            ->get();

        return $data_open;
    }

    public function response($complaint_id)
    {
        $complainer =  $this->complainerDetail($complaint_id);
        $responses =  $this->responseDetail($complaint_id);
        return view('complaints.response', compact('responses','complainer'));
    }

    public function complainerDetail($complaint_id)
    {
        $details = (array)DB::table('vw_complaints')
            ->select('*')
            ->where('complaint_id', '=', $complaint_id)
            ->first();
        return $details;

    }

    public function responseDetail($complaint_id)
    {
        $details = DB::table('response')
            ->select('*')
            ->where('complaint_id', '=', $complaint_id)
            ->get();
        return $details;

    }



    public function complaintOpening(Request $request){

        $open_complaints= $this->openComplaints();

        if ($request->ajax()){

            $open_complaints_search= $this->openComplaintsSearch($request->fullname);

            $table = "<table  style='width: 100%;' class='table table-bordered table-striped open-data-table'><tr><th>#</th><th>Full name</th><th>Complaint</th><th>Date</th><th>Action</th></tr>";

            $i = 1;
            foreach ($open_complaints_search as $open){

                $fullname  = $open->firstname.' '.$open->surname;
                $complaint = substr($open->complaint,0,100);
                $date = substr($open->date_complaint,0,11);

                $table .= "<tr><td style='width: 10%;'>&nbsp;$i</td>";
                $table .= "<td style='width: 20%;'>&nbsp;$fullname</td>";
                $table .= "<td style='width: 40%;'>&nbsp;$complaint</td>";
                $table .= "<td style='width: 10%;'>&nbsp;$date</td>";
                $table .= "<td>&nbsp;<a href='#'><span class='glyphicon glyphicon-eye-open'>view</span></a>";
                $table .= "<a href='#'>   <span class='fa fa-lock'>close</span></a></td></tr>";

                $i++;
            }

            $table .="</table> ";

            return $table;

        }

        $table = "<table class='table table-bordered table-striped open-data-table' ><tr><th>#</th><th>Full name</th><th>Complaint</th><th>Date</th><th>Action</th></tr>";

        $i=1;
        foreach ($open_complaints as $open){

            $fullname  = $open->firstname.' '.$open->surname;
            $complaint = substr($open->complaint,0,100);
            $date = substr($open->date_complaint,0,11);

            $table .= "<tr><td style='width: 10%;'>&nbsp;$i</td>";
            $table .= "<td style='width: 20%;'>&nbsp;$fullname</td>";
            $table .= "<td style='width: 40%;'>&nbsp;$complaint</td>";
            $table .= "<td style='width: 10%;'>&nbsp;$date</td>";
            $table .= "<td>&nbsp;<a href='#'><span class='glyphicon glyphicon-eye-open'>view</span></a>";
            $table .= "<a href='#'>   <span class='fa fa-lock'>close</span></a></td></tr>";

            $i++;
        }
        $table .="</table>";

        return $table;

    }

    private function openComplaintsSearch($fullname)
    {
        $data_open =  DB::table('complaints')
            ->leftJoin('complainer','complaints.complainer_id','=','complainer.complainer_id')
            ->join('schemes','schemes.scheme_id','=','complainer.scheme_id')
            ->select('complainer.firstname','complainer.surname','complainer.surname','complaints.complaint','complaints.date_complaint')
            ->where('complaint_status_id','=','1')
            ->where(DB::raw('concat(complainer.firstname," ",complainer.surname)') , 'LIKE' , '%'.$fullname.'%')
            ->paginate(10);
        return $data_open;
    }

    public function  closedComplaints(){

        $data_closed =  DB::table('complaints')
            ->leftJoin('complainer','complaints.complainer_id','=','complainer.complainer_id')
            ->join('schemes','schemes.scheme_id','=','complainer.scheme_id')
            ->select('complaints.complaint_id','complainer.firstname','complainer.surname','complainer.surname','complaints.complaint','complaints.date_complaint')
            ->where('complaint_status_id','=','2')
            ->get();

        return $data_closed;

    }

    private function closedComplaintsSearch($fullname)
    {
        $data_open =  DB::table('complaints')
            ->leftJoin('complainer','complaints.complainer_id','=','complainer.complainer_id')
            ->join('schemes','schemes.scheme_id','=','complainer.scheme_id')
            ->select('complainer.firstname','complainer.surname','complainer.surname','complaints.complaint','complaints.date_complaint')
            ->where('complaint_status_id','=','2')
            ->where(DB::raw('concat(complainer.firstname," ",complainer.surname)') , 'LIKE' , '%'.$fullname.'%')
            ->get();
        return $data_open;
    }

    public function complaintClosing(Request $request){

        $open_complaints= $this->closedComplaints();

        if ($request->ajax()){

            $open_complaints_search= $this->closedComplaintsSearch($request->fullname);

            $table = "<table class='table table-bordered table-striped'><tr><th>Full name</th><th>Complaint</th><th>Date</th><th>Action</th></tr>";

            foreach ($open_complaints_search as $open){

                $fullname  = $open->firstname.' '.$open->surname;
                $complaint = substr($open->complaint,0,100);
                $date = substr($open->date_complaint,0,11);

                $table .= "<tr><td>&nbsp;$fullname</td>";
                $table .= "<td>&nbsp;$complaint</td>";
                $table .= "<td>&nbsp;$date</td>";
                $table .= "<td>&nbsp;<a href='#'><span class='glyphicon glyphicon-eye-open'>view</span></a>";
                $table .= "<a href='#'>   <span class='fa fa-lock'>close</span></a></td></tr>";

            }

            $table .="</table>";

            return $table;

        }


        $table = "<table class='table table-bordered table-striped'><tr><th>Full name</th><th>Complaint</th><th>Date</th><th>Action</th></tr>";

        foreach ($open_complaints as $open){

            $fullname  = $open->firstname.' '.$open->surname;
            $complaint = substr($open->complaint,0,100);
            $date = substr($open->date_complaint,0,11);

            $table .= "<tr><td>$fullname</td>";
            $table .= "<td>$complaint</td>";
            $table .= "<td>$date</td>";
            $table .= "<td><a href='#'><span class='glyphicon glyphicon-eye-open'>view</span></a>";
            $table .= "<a href='#'>   <span class='fa fa-lock'>close</span></a></td></tr>";

        }
        $table .="</table>";

        return $table;

    }

    public function complaintPending(Request $request){

        $pending_complaints= $this->pendingComplaints();

        if ($request->ajax()){

            $pending_complaints_search= $this->closedComplaintsSearch($request->fullname);

            $table = "<table class='table table-bordered table-striped'><tr><th>Full name</th><th>Complaint</th><th>Date</th><th>Action</th></tr>";

            foreach ($pending_complaints_search as $pending){

                $fullname  = $pending->firstname.' '.$pending->surname;
                $complaint = substr($pending->complaint,0,100);
                $date = substr($pending->date_complaint,0,11);

                $table .= "<tr><td>&nbsp;$fullname</td>";
                $table .= "<td>&nbsp;$complaint</td>";
                $table .= "<td>&nbsp;$date</td>";
                $table .= "<td>&nbsp;<a href='#'><span class='glyphicon glyphicon-eye-open'>view</span></a>";
                $table .= "<a href='#'>   <span class='fa fa-lock'>close</span></a></td></tr>";

            }

            $table .="</table>";

            return $table;

        }


        $table = "<table class='table table-bordered table-striped'><tr><th>Full name</th><th>Complaint</th><th>Date</th><th>Action</th></tr>";

        foreach ($pending_complaints as $pending){

            $fullname  = $pending->firstname.' '.$pending->surname;
            $complaint = substr($pending->complaint,0,100);
            $date = substr($pending->date_complaint,0,11);

            $table .= "<tr><td>$fullname</td>";
            $table .= "<td>$complaint</td>";
            $table .= "<td>$date</td>";
            $table .= "<td><a href='#'><span class='glyphicon glyphicon-eye-open'>view</span></a>";
            $table .= "<a href='#'>   <span class='fa fa-lock'>close</span></a></td></tr>";

        }
        $table .="</table>";

        return $table;
    }

    public function  pendingComplaints(){

        $data_pending =  DB::table('complaints')
            ->leftJoin('complainer','complaints.complainer_id','=','complainer.complainer_id')
            ->join('schemes','schemes.scheme_id','=','complainer.scheme_id')
            ->select('complaints.complaint_id','complainer.firstname','complainer.surname','complainer.surname','complaints.complaint','complaints.date_complaint')
            ->where('complaint_status_id','=','3')
            ->paginate(10);

        return $data_pending;
    }

    public function search($fullsearch)
    {
        $search =  DB::table('complaints')
            ->join('complainer','complaints.complainer_id','=','complainer.complainer_id')
            ->join('schemes','schemes.scheme_id','=','complainer.scheme_id')
            ->join('complaint_status','complaint_status.complaint_status_id','=','complaints.complaint_status_id')
            ->where(
                [DB::raw('concat(complainer.firstname," ",complainer.surname)') ,'LIKE' , '%'.$fullsearch.'%'])
            ->orwhere(['complainer.residence'  ,'LIKE' , '%'.$fullsearch.'%'])
            ->orwhere(['complainer.ssno'  ,'LIKE' , '%'.$fullsearch.'%'])
            ->orwhere(['complainer.email'  ,'LIKE' , '%'.$fullsearch.'%'])
            ->orwhere(['complaints.date_complaint'  ,'LIKE' , '%'.$fullsearch.'%'])
            ->get();
        return $search;
    }


    public function editPending($complaint_id){

        $edit_complaints =(array)DB::table('vw_complaints')
            ->select('*')
            ->where('complaint_id', '=', $complaint_id)
            ->first();
        return view('complaints.editPending',compact('edit_complaints','complaint_id'));

    }

    public function  updatePending(Request $request,$complaint_id){

        $phone_number =  substr($request->get('phone'),1,9);
        $phone_number = '+255'.$phone_number;

        $complainer= DB::table('complaints')->select('complainer_id')->where('complaint_id', $complaint_id)->first();

        $complainer_id =  $complainer->complainer_id;


        $complainer = Complainer::find($complainer_id);

        $complainer->firstname =  $request->get('firstname');
        $complainer->surname =  $request->get('surname');
        $complainer->residence =  $request->get('residence');
        $complainer->phone =  $phone_number;
        $complainer->postal =  $request->get('postal');
        $complainer->email =  $request->get('email');
        $complainer->ssno =  $request->get('ssno');
        $complainer->employer =  $request->get('employer');

        $success = $complainer->save();

        if ($success)
        {


            $complaint = Complaint::find($complaint_id);

            $complaint->complaint =  $request->get('complaint');

            $success =   $complaint->save();

            if ($success){

                Session::flash('alert-success', 'successful  updated');

            } else {

                Session::flash('alert-warning', 'Failed to update');
            }

        }

        else {
            Session::flash('alert-warning', 'Failed to update Complainer');

        }

        return redirect('complaints/tab');

    }


    public function websiteStore(Request $request)
    {
        $phone_number =  substr($request->get('phone'),1,9);
        $phone_number = '+255'.$phone_number;

        $complainer = new Complainer();

        $complaint = new Complaint();

        $complainer->firstname = $request->get('first_name');
        $complainer->surname = $request->get('surname');
        $complainer->middlename = $request->get('middle_name');
        $complainer->postal = $request->get('postal');
        $complainer->residence = $request->get('residence');
        $complainer->phone = $phone_number;
        $complainer->email = $request->get('email');
        $complainer->ssinfo_id = $request->get('ssinfo_id');
        $complainer->scheme_id = $request->get('scheme_id');
        $complainer->ssno = $request->get('ssno');
        $complainer->employer = $request->get('employer');

        $success = $complainer->save();

        if ($success) {
            $refno = "S" .$complainer->complainer_id. "A";
            $complaint->complainer_id = $complainer->complainer_id;
            $complaint->complaint_type_id = $request->get('complaint_type_id');
            $complaint->complaint = $request->get('complaint');
            $complaint->date_complaint = Carbon::now();
            $complaint->refno = $refno;
            $complaint->complaint_count_id = $request->get('complaint_count_id');

            $complaint->save();

            $message= "Ndugu ".$complainer->firstname ."  ".$complainer->surname.",  Kufuatilia lalamiko lako, tuma ".$refno." kwenda namba 0762440706 au ingiza namba hiyo kwenye mfumo wetu ya malalamiko";

            $send_sms = SmsController::sendSms($message,$phone_number,'SSRA');

            Session::flash('alert-success', 'complaint successful  registered  and sms sent');


        } else {
            Session::flash('alert-warning', 'Failed to register complaint');
        }

        $message_website= "Ndugu ".$complainer->firstname ."  ".$complainer->surname.",  Kufuatilia lalamiko lako, tuma ".$refno." kwenda namba 0762440706";

        return  view('complaints.complainer', compact('message_website'));

    }
}
