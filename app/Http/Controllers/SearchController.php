<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Complaints\ComplaintsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('search');
    }
    public function apiSearch(Request $request)
    {
        $table = "";
        if ($request->ajax())
        {
            $search= $this->search($request->fullsearch);
            if (empty($request->fullsearch)){
                $table ="";
            } else {
                $table = "<table class='table table-bordered table-striped'><tr><th>Full name</th><th>Complaint</th><th>Date</th><th>Action</th></tr>";
                foreach ($search as $data){
                    $fullname  = $data->firstname.' '.$data->surname;
                    $email = substr($data->email,0,100);
                    $date = substr($data->date_complaint,0,11);
                    $complaint_id = $data->complaint_id;
                    $table .= "<tr><td height='50'>$fullname</td>";
                    $table .= "<td height='50'>$email</td>";
                    $table .= "<td height='50'>$date</td>";
                    $table .= "<td height='50'><a href='".url('complaints/response', $complaint_id)."'><span class='glyphicon glyphicon-eye-open'>view Responses</span></a>";
                }
                $table .="</table>";

                if (empty($fullname)){

                    $table ="<table class='table table-striped'><td colspan='12'><label class='label label-warning'>No Data Found For Your Search</label></td></table>";
                }
            }


        }
        return $table;
    }
    public function search($fullsearch)
    {
        $search =  DB::table('complaints')
            ->join('complainer','complaints.complainer_id','=','complainer.complainer_id')
            ->join('schemes','schemes.scheme_id','=','complainer.scheme_id')
            ->join('complaint_status','complaint_status.complaint_status_id','=','complaints.complaint_status_id')
            ->where(
                DB::raw('concat(complainer.firstname," ",complainer.surname)') ,'LIKE' , '%'.$fullsearch.'%')
            ->orwhere('complainer.residence'  ,'LIKE' , '%'.$fullsearch.'%')
            ->orwhere('complainer.ssno'  ,'LIKE' , '%'.$fullsearch.'%')
            ->orwhere('complainer.email'  ,'LIKE' , '%'.$fullsearch.'%')
            ->orwhere('complaints.date_complaint'  ,'LIKE' , '%'.$fullsearch.'%')
            ->paginate(10);
        return $search;
    }
}