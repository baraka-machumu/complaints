@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row" style="margin-left: 10px;">
        <form action="{{url('role')}}" method="post">
            {{ csrf_field() }}
            <div class="col-md-4">
                <h4>Taarifa Binafsi/Personal Information</h4>
                <div class="form-group">
                    <label for="first_name">Jina la Kwanza/First Name:</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" >
                </div>

                <div class="form-group">
                    <label for="last_name">Jina la ukoo/Last Name:</label>
                    <input type="text" class="form-control" id="last_name" name="last_name">
                </div>
                <div class="form-group">
                    <label for="middle_name">Jina La Kati/Middle Name:</label>
                    <input type="text" class="form-control" id="middle_name" name="middle_name">
                </div>
                <div class="form-group">
                    <label for="postal">S.L.P/P.O Box:</label>
                    <input type="text" class="form-control" id="postal" name="postal">
                </div>
                <div class="form-group">
                    <label for="residence">Makazi/Residence:</label>
                    <input type="text" class="form-control" id="residence" name="residence">
                </div>
                <div class="form-group">
                    <label for="phone_number">Simu/Phone Number:</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number">
                </div>
                <div class="form-group">
                    <label for="email">Barua Pepe/Email:</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
            </div>
            <div class="col-md-6">
                <h4>Taarifa za Hifadhi ya Jamii/Social Security Details</h4>
                <div class="form-group">
                    <label for="social_security_status">Hali ya Uanachama/Social Security Status:</label>
                    <select class="form-control" id="lgFormGroupInput" name="mfuko"  style="height: 35px; font-size: 14px" required>
                        <option selected="true" disabled="disabled">---Select Scheme--</option>
                        @foreach($membership_status as $status)
                            <option value="{{$status['id']}}">{{$status['name']}}</option>
                        @endforeach
                    </select>
                    {{--<input type="text" class="form-control" id="social_security_status" name="social_security_status" >--}}
                </div>
                <div class="form-group">
                    <label for="mfuko">Mfuko/Scheme:</label>
                    <select class="form-control" id="lgFormGroupInput" name="mfuko"  style="height: 35px; font-size: 14px" required>
                        <option selected="true" disabled="disabled">---Select Scheme--</option>
                        @foreach($all_scheme_types as $all_scheme_type)
                            <option value="{{$all_scheme_type['id']}}">{{$all_scheme_type['scheme_type_name']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="membership_number">Namba ya Uanachama / Membership Number:</label>
                    <input type="text" class="form-control" id="membership_number" name="membership_number" >
                </div>
                <div class="form-group">
                    <label for="employer">Mwajiri /Employer:</label>
                    <input type="text" class="form-control" id="employer" name="employer" >
                </div>
                <h4>Taarifa za Lalamiko/Complaints Details</h4>
                <div class="form-group">
                    <label for="complaint_type">Aina ya Lalamiko / Complaint Type</label>
                    <select class="form-control" id="lgFormGroupInput" name="complaint_type"  style="height: 35px; font-size: 14px" required>
                        <option selected="true" disabled="disabled">---Select Aina ya Lalamiko/Complaint Type--</option>
                        @foreach($complaintsTypes as $complaintsType)
                            <option value="{{$complaintsType['id']}}">{{$complaintsType['complaint_type_name']}}</option>
                        @endforeach
                    </select>
                    {{--<input type="text" class="form-control" id="complaint_type" name="complaint_type" >--}}
                </div>
                <div class="form-group">
                    <label for="complaint_type">Lalamiko binafsi au kikundi / Individual or Group Complaint</label>
                    <select name="complaint_type"  class="form-control">
                        <option value="binafsi">Binafsi</option>
                        <option value="kikundi">Kikundi</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="complaints">Lalamiko/Complaint*</label>
                    <textarea type="text" class="form-control" id="complaints" name="complaints" ></textarea>
                </div>
                <div class="form-group">
                    <label for="validator">Ingiza Herufi Hizi / Enter This Text </label>
                    <input type="text" class="form-control" id="validator" name="validator" >
                </div>
                <button type="submit" class="btn btn-primary">Tuma/Submit</button>
            </div>
        </form>
        @stop

        @section('css')

            <link rel="stylesheet" href="/css/admin_custom.css">
        @stop

        @section('js')
            <script> console.log('Hi!'); </script>
@stop