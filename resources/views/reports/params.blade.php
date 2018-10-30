@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

<link href="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" type="text/css" rel="stylesheet">
    <h4>{{ Breadcrumbs::render('report_select') }} </h4>

@stop

@section('content')



    <div class="row">
        <div class="col-md-6">

            <form method="post" action="{{url('report/params')}}">
                {{csrf_field()}}

            @if($report_data[0]->p1!==null)
                <div class="form-group">
                    <label for="start_date">{{$report_data[0]->p1_caption}}</label>
                    <input type="text" class="form-control role_name" id="start_date" name="data[{{$report_data[0]->p1}}]" >
                </div>

            @endif
            @if($report_data[0]->p2!==null)
                <div class="form-group">
                    <label for="end_date">{{$report_data[0]->p2_caption}}</label>
                    <input type="text" class="form-control role_name" id="end_date" name="data[{{$report_data[0]->p2}}]" >

                </div>
            @endif

            @if($report_data[0]->p3!==null)
                <div class="form-group">
                    <label for="scheme">{{$report_data[0]->p3_caption}}</label>
                    <input type="text" class="form-control role_name" id="scheme" name="data[{{$report_data[0]->p3}}]" >

                </div>
            @endif
            @if($report_data[0]->p4!==null)
                <div class="form-group">
                    <label for="complaint_type">{{$report_data[0]->p4_caption}}</label>
                    <input type="text" class="form-control role_name" id="complaint_type" name="data[{{$report_data[0]->p4}}]" >

                </div>
            @endif

            <button type="submit" class="btn btn-primary" name="get_report">Get Report</button>
            </form>

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
@section('js')
    <script>


        $('#start_date').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd'
        });
        $('#end_date').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd'

        });

</script>
@stop
