@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h5>{{ Breadcrumbs::render('complaint_create') }} </h5>
    <button class="btn btn-primary" data-toggle="modal" data-target="#comment" id="comment">Comment</button>

@stop
@section('content')

    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div>
    <!-- end .flash-message -->

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-condensed table-bordered">
                <tr>
                    <th style="width: 20%"> Full Name</th>
                    <td>{{$complainer->firstname.' '.$complainer->surname}}</td>

                </tr>
                <tr>
                    <th> Social Security details</th><td>{{$complainer->ssinfo_name}}</td>

                </tr>
                <tr>
                    <th>Email</th><td>{{$complainer->email}}</td>

                </tr>

                <tr>
                    <th>Phone</th><td>{{$complainer->phone}}</td>
                </tr>
                <tr>
                    <th>Social Security Number</th> <td>{{$complainer->ssno}}</td>

                </tr>
                <tr>
                    <th>Scheme Name	</th><td>{{$complainer->scheme_name}}</td>

                </tr>

                <tr>
                    <th>Complaints</th><td>{{$complainer->complaint}}</td>

                </tr>

            </table>
        </div>
    </div>

    <div class="row">

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

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-condensed table-bordered">

                <tr>
                    <th>#</th><th>Letter</th>

                </tr>
                <tbody>

                <?php $i = 1;?>

                @foreach($letter as $letters)
                    <tr>
                        <td>{{$i}}</td>
                        <td>
                            <a href="{{URL::asset('letter'.$letters->letter_link)}}">{{$letters->letter_link}}</a>

                        </td>

                    </tr>
                    <?php $i++; ?>
                @endforeach

                </tbody>

            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center;">Comment</h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-8">

                            <form action="{{url('complaints/comments/store', $refno)}}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" class="form-control comment" name="comment" >

                                <div class="form-group">
                                    <label for="comment">Comment:</label>
                                    <textarea type="text" class="form-control comment" id="comment"  name="comment" ></textarea>
                                </div>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close/Funga</button>
                                <button type="submit" class="btn btn-primary">Submit/Tuma</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')
    <script>
        $(document).ready(function () {

            $("#comment").click(function(){
                $('#myModal').modal('show');
            });
        });
    </script>
@stop





