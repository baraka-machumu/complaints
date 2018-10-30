

<div id="table-closed">


    <table class='table table-bordered table-striped' id="closed-data-table">
        <thead>
        <tr>
            <th>#</th><th>Full name</th><th>Complaint</th><th>Date submitted</th><th>Date Closed</th><th>Action</th>

        </tr>
        </thead>

        <?php $i=1;?>
        @foreach ($closed_complaints as $closed)
            <tr>
                <td>{{$i}}</td>
                <td>{{$closed->firstname.' '.$closed->surname}}</td>
                <td>{{substr($closed->complaint,0,100)."...."}}<a href="#" class="read_more" >Read More</a></td>
                <td>{{ substr($closed->date_complaint,0,10)}}</td>
                <td>{{ substr($closed->close_date,0,10)}}</td>
                <td><a href='#'><span class='glyphicon glyphicon-eye-open'>view Response</span></a>
                </td>
            </tr>

            <?php $i++;?>
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

