<?php

namespace App\Http\Controllers\Complaints;

use App\ComplaintType;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ComplaintsTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('user');
        $this->middleware('admin');
        $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $complaintsTypes = $this->getAllComplaintsType();
        return view('complaintsType.create', with(['complaintsTypes'=>$complaintsTypes]));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $complaintsTypes  =  new ComplaintType();
        $complaint_type_name = $request->get('complaint_type_name');

        $complaintsTypes->complaint_type_name  = $complaint_type_name;

        if (ComplaintType::where('complaint_type_name', '=', $request->get('complaint_type_name'))->exists()) {
            Session::flash('alert-warning', $request->get('complaint_type_name').' Complain Type Already Exists');
            return redirect('complaints-types/create');

        }

        $success =  $complaintsTypes->save();

        if ($success)
        {
            Session::flash('alert-success', 'successful Complaints type added');

        } else {
            Session::flash('alert-warning', 'Failed to add Complaints type');

        }
        $complaintsTypes  = $this->getAllComplaintsType();
        return redirect('complaints-types/create');
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
        return view('complaintsType.edit',compact(['id'=>$id]));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updates(Request $request)
    {
        $id  =  $request->get('id');

        $complaint_types =  ComplaintType::find($id);

        $complaint_types->complaint_type_name  =  $request->get('complaint_type_name');

//        dd($complaint_types);

        $success = $complaint_types->save();


        if ($success)
        {
            Session::flash('alert-success', 'successful Updated');

        } else {
            Session::flash('alert-warning', 'Failed to update, try again');

        }

        return redirect('complaints-types/create');

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

    public function getAllComplaintsType()
    {
        $complaintsTypes = ComplaintType::all()->toArray();
        return $complaintsTypes;
    }
}
