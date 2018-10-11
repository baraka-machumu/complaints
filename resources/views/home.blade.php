@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-folder-open "></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Open Complaints</span>
                    <span class="info-box-number">90<small>%</small></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-adjust"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Pending Complaints</span>
                    <span class="info-box-number">90<small>%</small></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa  fa-lock"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Closed Complaints</span>
                    <span class="info-box-number">90<small>%</small></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-5 col-xs-12" style="">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa-sum"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Complaints</span>
                    <span class="info-box-number">90<small>%</small></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    </div>


    <div class="row">
        <div class="col-md-12" style="">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Complaints By Line Graph</h3>
                    <div class="btn-group">
                        <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-wrench"></i></button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="javascript:void(0);" id="open-graph">Open Complaints Graph</a></li>
                            <li><a  href="javascript:void(0);" id="pending-graph"> Pending Complaints Graph</a></li>
                            <li><a  href="javascript:void(0);" id="closed-graph">Closed Complaints Graph</a></li>

                        </ul>
                    </div>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>

                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="">
                    <div class="row">
                        <div class="col-md-8">
                            <p class="text-center">
                                <strong>complaints</strong>
                            </p>

                            <div class="chart">
                                <!-- Sales Chart Canvas -->
                                <canvas class="salesChart" style="height: 180px; width: 645px;" width="967" height="270"></canvas>
                            </div>
                            <!-- /.chart-responsive -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-4">
                            <div class="box box-default">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Complaints  Pie Chart</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="chart-responsive">
                                                <canvas id="pieChart" height="150">

                                                </canvas>
                                            </div>
                                            <!-- ./chart-responsive -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-4">
                                            <ul class="chart-legend clearfix">
                                                <li><i class="fa fa-circle-o text-red"></i> Open</li>
                                                <li><i class="fa fa-circle-o text-yellow"></i>Pending </li>
                                                <li><i class="fa fa-circle-o text-green"></i> Closed</li>

                                            </ul>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>

                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
        </div>
        {{--box panel for table --}}



            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-body" style="">
                        <div class="box-header with-border">
                            <h3 class="box-title">Monthly Recap Report</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-wrench"></i></button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                    </ul>
                                </div>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>

                        <table class="table table-striped table-bordered table-condensed" id="roleTable">
                            <tr>
                                <th>#</th>
                                <th>Name of Scheme</th>
                                <th>Open Complaints</th>
                                <th>Pending Complaints</th>
                                <th>Closed Complaints</th>
                                <th>Tota Complaints</th>

                            </tr>
                            <tbody>
                            <?php $i =1?>
                            <tr>
                                <td>{{$i}}</td>
                                <td>ppf</td>
                                <td>2</td>
                                <td>2</td>
                                <td>2</td>
                                <td>2</td>

                            </tr>
                            <?php $i++;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @stop

        @section('css')
            <style>
                .content {
                    background-color:#ECF0F5;

                }

                .fa-sum:before {
                    content: "\03a3";
                    font-family: sans-serif;
                }

            </style>

        @stop

        @section('js')
            <script src="/complaints/js/chart.js"></script>
            <script src="/complaints/js/line.js"></script>

    consolo.log(333);


@stop


