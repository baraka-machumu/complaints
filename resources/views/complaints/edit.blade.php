

{{--<input type="text" id="search_edit" class="form-control" placeholder="search here">--}}
<div id="table">

    <table class='table table-bordered table-striped' id="edit-data-table">
        <thead>
        <tr><th>Full name</th><th>Complaint</th><th>Complaint Type</th><th>Action</th>

        </tr>
        </thead>

        @foreach ($edit_complaints as $editing)

        <tr><td>{{$editing->firstname.' '.$editing->surname}}</td>
           <td>{{substr($editing->complaint,0,100)}}</td>
           <td>{{ $editing->complaint_type_name}}</td>
            <td><a href='#'><span class='glyphicon glyphicon-edit'>Edit</span></a>
            </td>
        </tr>

    @endforeach
    </table>

</div>
