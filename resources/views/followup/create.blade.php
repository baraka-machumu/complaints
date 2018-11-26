@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h5>{{ Breadcrumbs::render('followup') }} </h5>
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

    <div class="col-md-12">
        <p>Ingiza Namba ya kumbukumbu / Enter Reference Number:</p>

    <form method="post" class="example" action="{{action('FollowupController@searchfollowup')}}">
        {{ csrf_field() }}
        <input type="text" placeholder="Search.." name="search" class="form-control">
        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
    </form>

    </div>
    </div>

@stop

@section('css')
    <style>
        form.example input[type=text] {

            font-size: 17px;
            float: left;
            width: 40%;
        }

        form.example button {
            float: left;
            width: 10%;

            color: white;

            border-left: none;
        }

        form.example::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
@stop





