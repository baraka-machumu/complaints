


<input type="text" placeholder="Search here" id="search_open" class="form-control">

<div id="table">



</div>


@section('js')
    <script>
        jQuery(document).ready(function(){


            jQuery.ajax({
                url: "{{ url('complaints/opening/all') }}",
                method: 'get',

                success: function(result){
                    $('#table').html(result);


                        console.log(result);
                }});

            jQuery('#search_open').on('keyup',function(e){
//                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    url: "{{ url('complaints/opening/all') }}",
                    method: 'get',
                    data: {
                        fullname: jQuery('#search_open').val()

                    },
                    success: function(result){

                        $('#table').html(result);

//                        console.log(result);
                    }});
            });
        });
    </script>

@stop