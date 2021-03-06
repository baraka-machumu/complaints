
<div id="">

    <table class='table table-bordered table-striped' id="pending-data-table">
        <thead>
        <tr>
            <th>Full name</th><th>Complaint</th><th>Date</th><th>Action</th><th>More Action</th>

        </tr>
        </thead>
        <tbody>

        @foreach ($pending_complaints as $pending)
            <tr>
                <td>{{$pending->firstname.' '.$pending->surname}}</td>
                <td>{{substr($pending->complaint,0,100)}}  <a href="{{action('Complaints\ComplaintsController@show', [$pending->complaint_id])}}">Read More</a></td>
                <td>{{ $pending->date_complaint}}</td>
                <td>
                    <a href="{{url('response/attend', [$pending->complaint_id,'actions'=>$actions['not_close']])}}" ><span class="glyphicon glyphicon-eye-open">open</span></a>
                    <a href="{{action('Complaints\ComplaintsController@editPending', $pending->complaint_id)}}"><span class='glyphicon glyphicon-edit'>Edit</span></a>
                </td>
                <td><a href="{{url('complaints/response', $pending->complaint_id)}}"><span class='glyphicon glyphicon-edit'>view</span></a>
                    <span style="margin-left: 1px;"><a href="{{action('Complaints\ResponseController@attend', [$pending->complaint_id,'actions'=>$actions['close']])}}"><span class='fa fa-lock'>close</span></a></span>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
