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

            <table class="table table-striped table-bordered table-condensed complaint_types" id="roleTable">
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
                        <td>{{ $complaintsType['complaint_type_name'] }}</td>
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


    <!-- Modal -->
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit Complaints Type</h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-8">

                            <form action="{{url('complaints-types/update')}}" method="post">
                                {{ csrf_field() }}

                                <input type="hidden" class="form-control id" name="id" >

                                <div class="form-group">
                                    <label for="username">complaints Type Name:</label>
                                    <input type="text" class="form-control complaint_type_name" id="complaint_type_name"  name="complaint_type_name" >
                                </div>
                    </div>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                    <div class="modal-footer">

                    </div>
                </div>
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
            <script>

                $(document).ready( function (e) {

                    $(".complaint_types").on('click', '.edit', function () {

                        var currentRow=$(this).closest("tr");

                        var complaint_type_name =currentRow.find("td:eq(1)").text();
                        var id =  currentRow.find("td:eq(0)").text();

                        $(".complaint_type_name").val(complaint_type_name);
                        $(".id").val(id);

                        console.log(complaint_type_name);

                    });


                });
            </script>
@stop