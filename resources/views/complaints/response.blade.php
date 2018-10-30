@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="clearfix"></div>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
        <table class="table table-striped table-condensed table-bordered">
            <tr>
                <th style="width: 20%"> Full Name</th><td>{{$complainer['firstname'].' '.$complainer['surname']}}</td>

            </tr>
            <tr>
                <th> Social Security details</th><td>{{$complainer['ssinfo_name']}}</td>

            </tr>
            <tr>
                <th>Email</th><td>{{$complainer['email']}}</td>

            </tr>
            <tr>
                <th>Phone</th><td>{{$complainer['phone']}}</td>


            </tr>
            <tr>
                <th>Social Security Number</th> <td>{{$complainer['ssno']}}</td>

            </tr>
            <tr>
                <th>Scheme Name	</th><td>{{$complainer['scheme_name']}}</td>

            </tr>
            <tr>
                <th>Status of Complaint	</th><td>{{$complainer['complaint_status_name']}}</td>

            </tr>
            <tr>
                <th>Close Date</th><td>{{$complainer['close_date']}}</td>

            </tr>
            <tr>
                <th>Complaints</th><td>{{$complainer['complaint']}}</td>

            </tr>

        </table>
        </div>
        <div class="col-md-12">

            <table class="table table-striped">
                <tr><td colspan="12" style="background-color: #3C8DBC; color: white">Reponse(s)</td></tr>

                @if(empty($responses))
                    <tr><th>Reponse</th> <td>No Reponse yet</td></tr>
                @endif
                @foreach($responses as $response)
                    <tr><th>Reponse</th> <td>{{$response->resp}}</td></tr>
                    @endforeach
            </table>
        </div>

    </div>
        @stop

