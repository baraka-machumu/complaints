/**
 * Created by fatuma.mkima on 10/12/2018.
 */

$(function () {

    summaryByScheme();

    var id = 9;
    $("#dash").append("<label id=lick me</label>");
    $("#"+id).click(function (e) {

        alert(9);
    });
});

function summaryByScheme()
{
    $.get('api/json/summary/byscheme', function (data)
    {
        console.log("summmary");

        var ids = "d";
        $("#summarybyscheme ").append("<tr><td></td></tr>");
        for(var i = 0; i<data.length; i++)
        {
             var id = "scheme-data-"+i;

            $("#summarybyschemeP").append("<tr id=id></tr>");
            for(var x = 0; x<5; x++)
            {
                // console.log(data[i][x]);
                $("#"+id).append("<td>"+data[i][x]+"</td>");
            }

        }

    });

}

