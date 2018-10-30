
$(function () {


    $('#closed-data-table').dataTable({
        "ordering": false
    });

    $('.read_more').click(function (e) {

        var complaint =  $(this).text();

        console.log(complaint);
        $('#read_more_modal').modal();

    });

});
