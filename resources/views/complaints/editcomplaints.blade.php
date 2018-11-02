@extends('adminlte::page')

@section('title', 'Dashboard')
@section('content_header')
    <div class="clearfix">
    </div>
    <h4>Edit Complaint</h4>

@stop

@section('content')

    <div class="row">
        <div class="flash-message">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))

                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                @endif
            @endforeach
        </div> <!-- end .flash-message -->
        <form method="post" action="{{action('Complaints\ComplaintsController@update', $id)}}" >
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            <div class="col-md-4">
                <div class="form-group">
                    <label for="firstname">First Name:</label>
                    <input disabled="disabled" type="text" class="form-control" id="firstname" name="firstname"  value="{{$complaint_edit[0]->firstname.' '.$complaint_edit[0]->surname}}" >
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="residence">Residence:</label>
                    <input disabled="disabled" type="text" class="form-control" id="residence" name="residence"  value="{{$complaint_edit[0]->residence}}" >
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="phone">Phone Number	:</label>
                    <input disabled="disabled" type="text" class="form-control" id="phone" name="phone"  value="{{$complaint_edit[0]->phone}}" >
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input disabled="disabled" type="text" class="form-control" id="email" name="email"  value="{{$complaint_edit[0]->email}}" >
                </div>
            </div>


            <div class="col-md-4">
                <div class="form-group">
                    <label for="ssno">Social Security details:</label>
                    <input disabled="disabled" type="text" class="form-control" id="ssno" name="ssno"  value="{{$complaint_edit[0]->ssno}}" >
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="ssno">Membership Number:</label>
                    <input disabled="disabled" type="text" class="form-control" id="ssno" name="ssno"  value="{{$complaint_edit[0]->ssno}}" >
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="employer">Current Employer/last	:</label>
                    <input disabled="disabled" type="text" class="form-control" id="employer" name="employer"  value="{{$complaint_edit[0]->employer}}" >
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="employer">Required Complaint Type:</label>
                    <select class="form-control" id="lgFormGroupInput" name="complaint_type_id"  style="height: 35px; font-size: 14px" required>
                        <option selected="true" disabled="disabled" value="">---Select Required Complaint Type --</option>
                        @foreach($complaint_types as $complaint_type)
                            <option value="{{ $complaint_type['complaint_type_id'] }}" {{ $complaint_type['complaint_type_id'] == $complaint_edit[0]->complaint_type_id ? 'selected' : '' }}>{{ $complaint_type['complaint_type_name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button style="margin-top: 80PX" type="submit" class="btn btn-primary">Save</button>

        </form>
        @stop
    </div>

