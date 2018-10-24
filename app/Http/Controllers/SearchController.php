<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Complaints\ComplaintsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{

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

                $table .= "<tr><td>$fullname</td>";
                $table .= "<td>$email</td>";
                $table .= "<td>$date</td>";
                $table .= "<td><a href='#'><span class='glyphicon glyphicon-eye-open'>view Responses</span></a>";

            }
            $table .="</table>";
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
