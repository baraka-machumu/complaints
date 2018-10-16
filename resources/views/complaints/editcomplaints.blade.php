@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="clearfix"></div>
@stop

@section('content')

    <div class="row">
        <form action="#" method="post">
            {{ csrf_field() }}
            <div class="col-md-4">
                <div class="form-group">
                    <label for="firstname">First Name:</label>
                    <input type="text" class="form-control" id="firstname" name="firstname"  value="{{$complaint_edit[0]->firstname}}" >
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
        @stop
    </div>