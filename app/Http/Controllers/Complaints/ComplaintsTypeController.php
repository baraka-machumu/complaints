<?php

namespace App\Http\Controllers\Complaints;

use App\ComplaintType;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ComplaintsTypeController extends Controller
{
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
        return view('complaints_type.create', with(['complaintsTypes'=>$complaintsTypes]));
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

        $complaintsTypes->role_name  = $complaint_type_name;

        if (Role::where('complaint_type_name', '=', $request->get('complaint_type_name'))->exists()) {
            Session::flash('alert-warning', $request->get('complaint_type_name').' Complain Type Already Exists');
            return redirect('complaints-types/create');

        }

        $success =  $complaintsTypes->save();

        if ($success)
        {
            Session::flash('alert-success', 'successful Role added');

        } else {
            Session::flash('alert-warning', 'Failed to add Role');

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
        //
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

    public function getAllComplaintsType()
    {
        $complaintsTypes = ComplaintType::all()->toArray();
        return $complaintsTypes;
    }
}
