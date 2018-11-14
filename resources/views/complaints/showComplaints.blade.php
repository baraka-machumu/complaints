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
                    <th>Complaints</th><td>{{$complainer['complaint']}}</td>

                </tr>

            </table>
        </div>
    </div>
@stop

