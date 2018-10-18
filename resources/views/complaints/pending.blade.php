
<div id="table-pending">

    <table class='table table-bordered table-striped' id="pending-data-table">
        <thead>
        <tr>
            <th>Full name</th><th>Complaint</th><th>Date</th><th>Action</th>

        </tr>
        </thead>

        @foreach ($pending_complaints as $pending)
            <tr><td>{{$pending->firstname.' '.$pending->surname}}</td>
                <td>{{substr($pending->complaint,0,100)}}</td>
                <td>{{ $pending->date_complaint}}</td>
                <td><a href='#'><span class='glyphicon glyphicon-edit'>view</span></a>
                </td>
                <td><a href='#'><span class='fa fa-lock'>close</span></a></td>

            </tr>

        @endforeach
    </table>

</div>
<script>

</script>



