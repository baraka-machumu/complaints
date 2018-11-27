@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h5>{{ Breadcrumbs::render('complaint_create') }} </h5>
@stop
@section('content')
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
@stop

@section('css')

@stop





