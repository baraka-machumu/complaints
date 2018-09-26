@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
    <hr>
    <div class="clearfix"></div>
@stop

@section('content')
    <form action="{{url('user')}}" method="post">
        {{ csrf_field() }}

        <div class="flash-message">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))

                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                @endif
            @endforeach
        </div> <!-- end .flash-message -->

        <div class="row">
            <div class="col-md-4">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" >
        </div>

        <div class="form-group">
            <label for="email">Email address:</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
            </div>
            <div class="col-md-8">

                @if($userData==null)

                    @else

                <table class="table table-striped">
                    <tr><td colspan="12">User Details</td></tr>
                    <tr>
                        <td>#</td>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Date</td>
                    </tr>
                    <tbody>
                    <tr>

                        <td>1</td>
                        <td>{{$userData['name']}}</td>
                        <td>{{$userData['email']}}</td>
                        <td>{{ substr($userData['created_at'],0,10)}}</td>
                    </tr>
                    </tbody>
                </table>
                    @endif

            </div>
        </div>
    </form>
@stop

@section('css')
    <style>
        .content-wrapper {
            background-color:white;
        }
    </style>

@stop

@section('js')
    {{--<script> console.log('Hi!'); </script>--}}
@stop