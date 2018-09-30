@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <hr>
    <div class="clearfix"></div>
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
        <form action="{{url('complaints-types')}}" method="post">
            {{ csrf_field() }}
            <div class="col-md-4">
                <div class="form-group">
                    <label for="complaint_type_name">Complaints Type:</label>
                    <input type="text" class="form-control" id="complaint_type_name" name="complaint_type_name" >
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>

        <div class="col-md-8">

            <table class="table table-striped table-bordered table-condensed" id="roleTable">
                <tr><td colspan="12">Complaints Type</td></tr>
                <tr>
                    <th>#</th>
                    <th> Complaints Type Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <tbody>
                <?php $i =1?>
                @foreach($complaintsTypes as $complaintsType)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{ $complaintsType['role_name'] }}</td>
                        <td style="display: none">{{ $complaintsType['id'] }}</td>
                        <td><a href="#" class="glyphicon glyphicon-pencil edit" data-toggle="modal" data-target="#edit">
                            </a>
                        </td>
                        <td>
                            <form action="#" method="post">
                                {{ csrf_field() }}
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="submit" class="btn btn-link">
                                    <span onClick="return confirm('Are you absolutely sure you want to delete user?')" class="glyphicon glyphicon-trash"></span>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php $i++;?>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


        @stop
        @section('css')
            <style>
                .content-wrapper {
                    background-color:white;
                }
            </style>

        @stop

        @section('js')

@stop