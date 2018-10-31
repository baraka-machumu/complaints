@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h4>{{Breadcrumbs::render('role/create')}}</h4>
    <h4>Attend Response for the First Time</h4>

@stop

@section('content')

    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div> <!-- end .flash-message -->

    <div class="row">
        <form method="post" action="{{action('Complaints\ResponseController@storeResponse',$complaint_id)}}" enctype="multipart/form-data">
        <div class="col-md-6">

            <div class="form-group">
                <label for="fullname">Full Name</label>
                <input type="text" class="form-control" id="fullname" name="fullname" value="{{$complainer_details['firstname'].' '.$complainer_details['surname']}}" readonly>
            </div>
            <div class="form-group">
                <label for="residence">Residence</label>
                <input type="text" class="form-control" id="residence" name="residence" readonly value="{{$complainer_details['residence']}}">
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" class="form-control" id="phone" name="phone" readonly value="{{$complainer_details['phone']}}">
            </div>
            <div class="form-group">
                <label for="complaint_type">Required Complaint Type</label>

                <select type="text" class="form-control" id="complaint_type" name="complaint_type" >
                    @foreach($complaint_type as $type)
                        <option value="{{$type['complaint_type_id']}}" {{ $type['complaint_type_id'] == $type['complaint_type_id'] ? 'selected' : '' }}>{{$type['complaint_type_name']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="ss_details">Social Security Details</label>
                <input type="text" class="form-control" id="ss_details" value="{{$complainer_details['ssinfo_name']}}" name="ss_details" readonly>
            </div>
            <div class="form-group">
                <label for="scheme">Scheme</label>
                <input type="text" class="form-control" value="{{$complainer_details['scheme_name']}}" id="scheme" name="scheme" readonly >
            </div>

        </div>
        <div class="col-md-6">

            <div class="form-group">
                <label for="membership_number">Memberhip Number</label>
                <input type="text" class="form-control" value="{{$complainer_details['ssno']}}" id="membership_number" name="membership_number" readonly>
            </div>
            <div class="form-group">
                <label for="employer">Employer</label>
                <input type="text" class="form-control" value="{{$complainer_details['employer']}}" id="employer" name="employer" readonly >
            </div>
            <div class="form-group">
                <label for="complaint">Complaint</label>
                <textarea type="text" class="form-control" id="complaint" name="complaint" readonly>{{$complainer_details['complaint']}}</textarea>

            </div>
            <div class="form-group">
                <label for="response_type">Response Type</label>
                <select type="text" class="form-control" id="response_type" name="response_type" >
                    <option selected="true" disabled="disabled" value="">Select Response Type</option>
                    @foreach($response_type as $type)
                        <option value="{{$type['responsetype_id']}}">{{$type['responsetype_name']}}</option>
                        @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="reponse_details">Response Details</label>
                <textarea type="text" class="form-control"  id="reponse_details" name="reponse_details"></textarea>
            </div>
            <div class="form-group">
                <label for="scheme">Upload Document</label>
                <input type="file"  id="file-upload" name="letters[]"   class="file" data-overwrite-initial="true">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>

        </div>
        </form>
    </div>
        @stop
        @section('css')

        @stop

        @section('js')

            <script>

//                $("#file-upload").fileinput({
//
//                    allowedFileExtensions: ['pdf', 'png','jpg'],
//                    maxFileSize:10000,
//                    maxFilesNum: 10
//
//                });

            </script>

@stop