

<div id="table-closed">


    <table class='table table-bordered table-striped' id="closed-data-table">
        <thead>
        <tr>
            <th>Full name</th><th>Complaint</th><th>Date</th><th>Action</th>

        </tr>
        </thead>

        @foreach ($delayed_complaints as $delayed)
            <tr><td>{{$delayed->firstname.' '.$delayed->surname}}</td>
                <td>{{substr($delayed->complaint,0,100)}}</td>
                <td>{{ $delayed->date_complaint}}</td>
                <td><a href="{{url('complaints/response', $delayed->complaint_id)}}"><span class='glyphicon glyphicon-eye-open'>view</span></a>
                </td>
            </tr>

        @endforeach
    </table>

</div>



<!-- Modal -->
<div class="modal fade" id="read_more_modal" tabindex="-1" role="dialog" aria-labelledby="readmore_model">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Read More</h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12" id="read_more_complaint">


                    </div>
                </div>

            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>

