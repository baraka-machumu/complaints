@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')


        <ul class="nav nav-tabs">
            <li class="active">
                <a  href="#1" data-toggle="tab"><span class="glyphicon glyphicon-edit"></span> Edit Complaints</a>
            </li>
            <li><a href="#2" data-toggle="tab"><span class="fa fa-folder-open"></span>Open Complaints</a>
            </li>
            <li><a href="#3" data-toggle="tab"><span class="fa fa-adjust"></span>Pending Complaints</a>
            </li>
            <li><a href="#4" data-toggle="tab"><span class="fa fa-lock"></span>Closed Complaints</a>
            </li>
            <li><a href="#5" data-toggle="tab"><span class="glyphicon glyphicon-edit"></span>Delayed Complaints</a>
            </li>
            <li><a href="#6" data-toggle="tab"><span class="glyphicon glyphicon-edit"></span>Overdue Complaints</a>
            </li>
        </ul>

        <div class="tab-content" style="  border-left: 1px solid #ddd;
        border-right: 1px solid #ddd; border-bottom: 1px solid #ddd;
        padding: 10px;" >

            <div class="tab-pane active" id="1" style="background-color: white">

                @include('complaints.edit',compact('edit_complaints'))

            </div>

            <div class="tab-pane" id="2" style="background-color: white">

                @include('complaints.open',compact('open_complaints'))

            </div>

            <div class="tab-pane" id="3" style="background-color: white">


                @include('complaints.pending',compact('pending_complaints'))

            </div>

            <div class="tab-pane" id="4" style="background-color: white;">

                @include('complaints.closed',compact('closed_complaints'))


            </div>
            <div class="tab-pane" id="5" style="background-color: white">

            </div>
            <div class="tab-pane" id="6" style="background-color: white">

            </div>
        </div>
    </div>
@stop


@section('js')

    <script src="/complaints/js/tab_open.js"></script>
    <script src="/complaints/js/tab_edit.js"></script>
    <script src="/complaints/js/tab_pending.js"></script>
    <script src="/complaints/js/tab_closed.js"></script>


@stop




