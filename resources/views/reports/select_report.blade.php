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

            {{--<h4 class="list-group-item active">Please Select Report you want from here</h4>--}}
            <a href="#" class="list-group-item" >Summary Report Complaints</a>
            <a href="#" class="list-group-item">No of complaints Per category</a>
            <a href="#" class="list-group-item">No of complaints Per category by date</a>
            <a href="#" class="list-group-item">Filter per scheme</a>
            <a href="#" class="list-group-item">Filter per category</a>
            <a href="#" class="list-group-item">Search complaints</a>
            <a href="#" class="list-group-item">Search by date</a>

        </div>
        <div class="col-md-6">

            <a href="#" class="list-group-item">Search Detailed Report by date</a>
            <a href="#" class="list-group-item">Mobile app Complaints</a>
            <a href="#" class="list-group-item">Website Complaints</a>
            <a href="#" class="list-group-item">Letter complaints</a>
            <a href="#" class="list-group-item">Face to face complaints</a>
            <a href="#" class="list-group-item">Phone call complaints</a>
            <a href="#" class="list-group-item">Email Complaints</a>

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




