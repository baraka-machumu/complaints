

<div id="table-closed">


    <table class='table table-bordered table-striped' id="closed-data-table">
        <thead>
        <tr>
            <th>Full name</th><th>Complaint</th><th>Date</th><th>Action</th>

        </tr>
        </thead>

        @foreach ($closed_complaints as $closed)
            <tr><td>{{$closed->firstname.' '.$closed->surname}}</td>
                <td>{{substr($closed->complaint,0,100)}}</td>
                <td>{{ $closed->date_complaint}}</td>
                <td><a href='#'><span class='glyphicon glyphicon-eye-open'>view</span></a>
                </td>
            </tr>

        @endforeach
    </table>

</div>


