<?php

namespace App\Http\Controllers\Complaints;

use App\Complaint;
use App\ComplaintType;
use App\MembershipStatus;
use App\Scheme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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
        $membership_status = MembershipStatus::all()->toArray();
        $all_scheme_types = Scheme::all()->toArray();
        $complaintsTypes = ComplaintType::all()->toArray();
        return view('complaints.create', with(['all_scheme_types'=>$all_scheme_types,'complaintsTypes'=>$complaintsTypes
            ,'membership_status'=>$membership_status]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $complaint_type = ComplaintType::all()->toArray();
        $schemes = Scheme::all()->toArray();
        $data = $this->editComplaintsDetails($id);

        $complaint_edit =[];

        foreach ($data as $data_edit){

            array_push($complaint_edit,$data_edit);
        }
        return view('complaints.editcomplaints', compact('complaint_edit', 'complaint_type', 'schemes', 'id'));
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
        //
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
//        $complaint_edit =  $this->editComplaints();
        return view('complaints.tab');
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
            ->paginate(10);
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





    public function complaintTab(){

        return view('complaints.tab');

    }

    public function  openComplaints(){

        $data_open =  DB::table('complaints')
            ->leftJoin('complainer','complaints.complainer_id','=','complainer.complainer_id')
            ->join('schemes','schemes.scheme_id','=','complainer.scheme_id')
            ->select('complainer.firstname','complainer.surname','complainer.surname','complaints.complaint','complaints.date_complaint')
            ->where('complaint_status_id','=','1')
            ->paginate(20);

        return $data_open;

    }

    public function complaintOpening(Request $request){

        $open_complaints= $this->openComplaints();

        if ($request->ajax()){

            $open_complaints_search= $this->openComplaintsSearch($request->fullname);

            $table = "<table class='table table-bordered table-striped'><tr><th>Full name</th><th>Complaint</th><th>Date</th><th>Action</th></tr>";

            foreach ($open_complaints_search as $open){

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

    private function openComplaintsSearch($fullname)
    {
        $data_open =  DB::table('complaints')
            ->leftJoin('complainer','complaints.complainer_id','=','complainer.complainer_id')
            ->join('schemes','schemes.scheme_id','=','complainer.scheme_id')
            ->select('complainer.firstname','complainer.surname','complainer.surname','complaints.complaint','complaints.date_complaint')
            ->where('complaint_status_id','=','1')
            ->where(DB::raw('concat(complainer.firstname," ",complainer.surname)') , 'LIKE' , '%'.$fullname.'%')
            ->paginate(20);
        return $data_open;
    }


}
