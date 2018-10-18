

{{--<input type="text" placeholder="Search here" id="search_open" class="form-control">--}}

<div id="table-open">


    <table class='table table-bordered table-striped' id="open-data-table">
        <thead>
        <tr>
            <th>Full name</th><th>Complaint</th><th>Date</th><th>Action</th>

        </tr>
        </thead>

        @foreach ($open_complaints as $open)
        <tr><td>{{$open->firstname.' '.$open->surname}}</td>
            <td>{{substr($open->complaint,0,100)}}</td>
            <td>{{ $open->date_complaint}}</td>
            <td><a href='#'><span class='glyphicon glyphicon-edit'>view</span></a>
            </td>
        </tr>

        @endforeach
    </table>

</div>




