<input type="text" id="search_edit" class="form-control" >
<div id="table">



</div>

@section('js')
    <script>
        jQuery(document).ready(function(){


            jQuery.ajax({
                url: "{{ url('api/complaints/editing/all') }}",
                method: 'get',

                success: function(result){
                    $('#table').html(result);


//                    console.log(result);
                }});

            jQuery('#search_edit').on('keyup',function(e){
//                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    url: "{{ url('api/complaints/editing/all') }}",
                    method: 'get',
                    data: {
                        fullname: jQuery('#search_edit').val()

                    },
                    success: function(result){

                        $('#table').html(result);

                        console.log(result);
                    }});
            });
        });
    </script>

@stop
