@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row" style="margin-left: 10px;">
        <form action="" method="post">
            {{csrf_field()}}
            <div class="col-md-4">
                <h4>Personal Information</h4>
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" >
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" class="form-control" id="last_name" name="last_name">
                </div>
                <div class="form-group">
                    <label for="middle_name">Middle Name:</label>
                    <input type="text" class="form-control" id="middle_name" name="middle_name">
                </div>
                <div class="form-group">
                    <label for="postal">P.O Box:</label>
                    <input type="text" class="form-control" id="postal" name="postal">
                </div>
                <div class="form-group">
                    <label for="residence">Residence:</label>
                    <input type="text" class="form-control" id="residence" name="residence">
                </div>
                <div class="form-group">
                    <label for="phone_number">Phone Number:</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
            </div>
            <div class="col-md-6">
                <h4>Social Security Details</h4>
                <div class="form-group">
                    <label for="social_security_status">Social Security Status:</label>
                    <select class="form-control" id="lgFormGroupInput" name="mfuko"  style="height: 35px; font-size: 14px" required>
                        <option selected="true" disabled="disabled">---Select social security status--</option>
                        @foreach($membership_status as $status)
                            <option value="{{$status['ssinfo_id']}}">{{$status['ssinfo_name']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="mfuko">Scheme:</label>
                    <select class="form-control" id="lgFormGroupInput" name="mfuko"  style="height: 35px; font-size: 14px" required>
                        <option selected="true" disabled="disabled">---Select Scheme--</option>
                        @foreach($all_scheme_types as $all_scheme_type)
                            <option value="{{$all_scheme_type['scheme_id']}}">{{$all_scheme_type['scheme_name']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="membership_number">Membership Number:</label>
                    <input type="text" class="form-control" id="membership_number" name="membership_number" >
                </div>
                <div class="form-group">
                    <label for="employer">Employer:</label>
                    <input type="text" class="form-control" id="employer" name="employer" >
                </div>
                <h4>Complaints Details</h4>
                <div class="form-group">
                    <label for="complaint_type">Complaint Type</label>
                    <select class="form-control" id="lgFormGroupInput" name="complaint_type"  style="height: 35px; font-size: 14px" required>
                        <option selected="true" disabled="disabled">---Select Aina ya Lalamiko/Complaint Type--</option>
                        @foreach($complaintsTypes as $complaintsType)
                            <option value="{{$complaintsType['complaint_type_id']}}">{{$complaintsType['complaint_type_name']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="complaint_type">Individual or Group Complaint</label>
                    <select name="complaint_type"  class="form-control">
                        <option value="binafsi">Binafsi</option>
                        <option value="kikundi">Kikundi</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="complaints">Complaint*</label>
                    <textarea type="text" class="form-control" id="complaints" name="complaints" ></textarea>
                </div>
                <div class="form-group">
                    <label for="validator">Enter this Text </label>
                    <input type="text" class="form-control" id="validator" name="validator" >
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        @stop

        @section('css')

        @stop

        @section('js')
            <script> console.log('Hi!'); </script>
@stop
    </div>