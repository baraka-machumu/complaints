@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h4>Edit Complaint</h4>

@stop
@section('content')
    <div class="row">

        <form method="post" action="{{action('Complaints\ComplaintsController@updatePending',['complaint_id'=>$complaint_id])}}">

            {{ csrf_field() }}

            <div class="col-md-6">
                <div class="form-group">
                    <label for="fullname">First Name</label>
                    <input type="text" class="form-control" id="fullname" name="firstname" value="{{$edit_complaints['firstname']}}">
                </div>
                <div class="form-group">
                    <label for="fullname">Last Name</label>
                    <input type="text" class="form-control" id="fullname" name="surname" value="{{$edit_complaints['surname']}}">
                </div>
                <div class="form-group">
                    <label for="residence">Residence</label>
                    <input type="text" class="form-control" id="residence" name="residence" value="{{$edit_complaints['residence']}}">
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{$edit_complaints['phone']}}">
                </div>
                <div class="form-group">
                    <label for="postal">Postal Address</label>
                    <input type="text" class="form-control" id="postal" value="{{$edit_complaints['postal']}}" name="postal" >
                </div>



            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" value="{{$edit_complaints['email']}}" id="email" name="email">
                </div>

                <div class="form-group">
                    <label for="ssno">Membership Number	</label>
                    <input type="text" class="form-control" value="{{$edit_complaints['ssno']}}" id="ssno" name="ssno" >
                </div>
                <div class="form-group">
                    <label for="employer">Employer</label>
                    <input type="text" class="form-control" value="{{$edit_complaints['employer']}}" id="employer" name="employer" >
                </div>
                <div class="form-group">
                    <label for="complaint">Complaints</label>
                    <textarea id="complaint" class="form-control" name="complaint" rows="7">{{ $edit_complaints['complaint']}}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>

            </div>
        </form>
    </div>
@stop
@section('css')

@stop

@section('js')


@stop