@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h5>{{ Breadcrumbs::render('complaint_create') }} </h5>
@stop
@section('content')
    <div class="row" style="margin-top: -30px">
        <div class="col-md-12 flash-message">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))

                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                @endif
            @endforeach
        </div>
        <!-- end .flash-message -->

        <table class='table table-bordered table-striped' id="comments-data-table">
            <thead>
            <tr>
                <th>Full name</th><th>Complaint</th><th>Date</th><th>Action</th>

            </tr>
            </thead>

            {{--@foreach ($closed_complaints as $closed)--}}
                {{--<tr><td>{{$closed->firstname.' '.$closed->surname}}</td>--}}
                    {{--<td>{{substr($closed->complaint,0,100)}}</td>--}}
                    {{--<td>{{ $closed->date_complaint}}</td>--}}
                    {{--<td><a href="{{url('complaints/response', $closed->complaint_id)}}"><span class='glyphicon glyphicon-eye-open'>view</span></a>--}}
                    {{--</td>--}}
                {{--</tr>--}}

            {{--@endforeach--}}
        </table>
    </div>
@stop

@section('css')
    <style>

        h4{
            background-color: #3C8DBC;
            height: 25px;
            color: white;
            border-radius: 1px;
        }
        label{
            font-weight: normal;
        }
    </style>

    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>

        $(document).ready(function (e) {



                $('#comments-data-table').dataTable({
                    "ordering": false,
                    "lengthChange": false
                });



            $('#ssinfo').select2({
                placeholder: "Select social security status",
                allowClear: true
            });

            $('#scheme').select2({
                placeholder: "Select Scheme",
                allowClear: true
            });
            $('#complaint_type').select2({
                placeholder: "Select Scheme",
                allowClear: true
            });

            $('#complaint_rec_mode_id').select2({
                placeholder: "Select Complaint Receive Mode",
                allowClear: true
            });

            $("#phone").keyup(function (e) {

                var phoneNo = $('#phone').val();

                if (phoneNo.length ==10)
                {
                    $('#save-create').prop("disabled", false);
                }
                else {
                    $('#save-create').prop("disabled", true);
                }
                });


                $("#phone").keydown(function (e) {

                var phoneNo =  $('#phone').val();

                if(phoneNo.length==9)
                {
                    $('#save-create').prop("disabled", false);
                }
                else
                {
                    $('#save-create').prop("disabled", true);
                }

                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
                    // Allow: Ctrl+A, Command+A
                    (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                    // Allow: home, end, left, right, down, up
                    (e.keyCode >= 35 && e.keyCode <= 40)) {
                    // let it happen, don't do anything
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });

        });

        var input = document.querySelector("#phone");
        window.intlTelInput(input, {onlyCountries: ["tz"]});



    </script>
@stop




