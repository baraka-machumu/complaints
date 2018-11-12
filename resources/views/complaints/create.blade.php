@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h5>{{ Breadcrumbs::render('complaint_create') }} </h5>
@stop
@section('content')
    <div class="row" style="margin-top: -30px">
        <form action="{{action('Complaints\ComplaintsController@store')}}" method="post">
            {{ csrf_field() }}
            <div class="col-md-4">
                <h4>Taarifa Binafsi/Personal Information</h4>
                <div class="form-group">
                    <label for="first_name">Jina la Kwanza/First Name:</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" >
                </div>

                <div class="form-group">
                    <label for="surname">Jina la ukoo/Last Name:</label>
                    <input type="text" class="form-control" id="surname" name="surname">
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
                    <label for="phone">Simu/Phone Number:</label>
                    <input type="text" class="form-control" id="phone" name="phone">
                </div>

                <div class="form-group">
                    <label for="email">Barua Pepe/Email:</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
            </div>
            <div class="col-md-6">
                <h4>Social Security Details</h4>
                <div class="form-group">
                    <label for="ssinfo">Social Security Status:</label>
                    <select class="form-control" id="ssinfo" name="ssinfo_id"  style="height: 35px; font-size: 14px" required>
                        @foreach($membership_status as $status)
                            <option value="{{$status['ssinfo_id']}}">{{$status['ssinfo_name']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="scheme">Scheme:</label>
                    <select class="form-control" id="scheme" name="scheme_id"  style="height: 35px; font-size: 14px" required>
                        @foreach($all_scheme_types as $all_scheme_type)
                            <option value="{{$all_scheme_type['scheme_id']}}">{{$all_scheme_type['scheme_name']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="ssno">Membership Number:</label>
                    <input type="text" class="form-control" id="ssno" name="ssno" >
                </div>
                <div class="form-group">
                    <label for="employer">Employer:</label>
                    <input type="text" class="form-control" id="employer" name="employer" >
                </div>


                <h4>Complaints Details</h4>

                <div class="form-group">
                    <label for="complaint_rec_mode_id">Complaint Receive Mode:</label>
                    <select class="form-control" id="complaint_rec_mode_id" name="complaint_rec_mode_id"  style="height: 35px; font-size: 14px" required>
                        @foreach($rec_modes as $rec_mode)
                            <option value="{{$rec_mode['complaint_rec_mode_id']}}">{{$rec_mode['complaint_rec_mode_name']}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="complaint_type">Complaint Type</label>
                    <select class="form-control" id="complaint_type" name="complaint_type_id"  required>
                        @foreach($complaintsTypes as $complaintsType)
                            <option value="{{$complaintsType['complaint_type_id']}}">{{$complaintsType['complaint_type_name']}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="complaints">Lalamiko/Complaint</label>
                    <textarea type="text" class="form-control" id="complaint" name="complaint" ></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Tuma/Submit</button>
            </div>
        </form>
    </div>
@stop

@section('css')
    <style>

        h4{
            background-color: #3C8DBC;
            height: 25px;
            color: white;
            border-radius: 1px;
        }
        label{
            font-weight: normal;
        }
    </style>

    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>

        $(document).ready(function (e) {

            $('#ssinfo').select2({
                placeholder: "Select social security status",
                allowClear: true
            });

            $('#scheme').select2({
                placeholder: "Select Scheme",
                allowClear: true
            });
            $('#complaint_type').select2({
                placeholder: "Select Scheme",
                allowClear: true
            });

            $('#complaint_rec_mode_id').select2({
                placeholder: "Select Complaint Receive Mode",
                allowClear: true
            });


        });

    </script>
@stop




