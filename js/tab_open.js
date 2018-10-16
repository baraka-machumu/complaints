

jQuery(document).ready(function(){

    jQuery.ajax({
        url: "/complaints/api/complaints/opening/all",
        method: 'get',

        success: function(result){
            $('#table-open').html(result);


// console.log(result);
        }});

    jQuery('#search_open').on('keyup',function(e){
//                e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "/complaints/api/complaints/opening/all",
            method: 'get',
            data: {
                fullname: jQuery('#search_edit').val()

            },
            success: function(result){

                $('#table-open').html(result);

                console.log(result);
            }});
    });

});