/**
 * Created by Dusan on 10.11.2016..
 */

$("document").ready(function() {
    $("#trips").click(function(){
        getData("trips");
    });
    $("#passengers").click(function(){
        getData("passengers");
    });
});

function getData(data){
    $.ajax({
        url: 'table.php',
        data: {
            "table":data
        },
        type: "GET",
    }).done(function( table ) {
        $( "#response" ).html( table );
    });
}




