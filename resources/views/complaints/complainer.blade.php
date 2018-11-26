@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h5>{{ Breadcrumbs::render('complaint_create') }} </h5>
@stop
@section('content')

    <div class="row">
       <div class="col-md-12">
           <div class="flash-message">
               @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                   @if(Session::has('alert-' . $msg))

                       <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                   @endif
               @endforeach
           </div> <!-- end .flash-message -->
       </div>

        <div class="col-md-12">

            <p style="font-size: 16px;">
                {{$message_website}} au bofya <a href="{{url('complaints/followups')}}">Fuatilia lalamiko</a>

            </p>


        </div>

    </div>

@stop






