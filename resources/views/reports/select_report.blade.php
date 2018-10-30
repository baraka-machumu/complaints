@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    <h4>{{ Breadcrumbs::render('report_select') }} </h4>

@stop

@section('content')

    <div class="row">

        <div class="col-md-12" >
            <div class="col-md-12" style="background-color: #3C8DBC; color: white">
                <h4>Please Select Report you want from here</h4>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">

            @foreach($report_names as $report_name)

            <a href="{{route('report_get', ['id'=>$report_name->id])}}" class="list-group-item" >{{$report_name->report_name}}</a>

                @endforeach
        </div>
        <div class="col-md-6">


            <div class="form-group">


            </div>


        </div>
    </div>
@stop

@section('css')
    <style>
       .row  a{
            color: #3C8DBC;
        }

    </style>

@stop




