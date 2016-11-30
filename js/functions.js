/**
 * Created by Dusan on 10.11.2016..
 */

$("document").ready(function() {
    $("#trips").click(function(){
        getData("trips","asc");
    });
    $("#passengers").click(function(){
        getData("passengers","asc");
    });
});

function getData(data,sort){
    $.ajax({
        url: 'table.php',
        data: {
            "table":data,
            "sort":sort
        },
        type: "GET",
    }).done(function( table ) {
        $( "#response" ).html( table );
    });
}




