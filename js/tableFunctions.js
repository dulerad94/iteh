$("#addTrip").click(function(){
    getForm("formTrip.php",null);
});
$("#addPassenger").click(function(){

    getForm("formPassenger.php",null);
});
$(".btnChange").click(function () {
    var id=$(this).attr('id').substring($(this).attr('id').indexOf("-")+1);
    var table=$(this).attr('class').substring($(this).attr('class').indexOf(" ")+1);
    table=table.substr(0,table.length-1);
    var firstLetter=table.charAt(0);
    table=table.substr(1);
    table=firstLetter+table;
    getForm("form"+table+".php",id);
});
$(".btnRemove").click(function(){
    var id=$(this).attr('id').substring($(this).attr('id').indexOf("-")+1);
    var table=$(this).attr('class').substring($(this).attr('class').indexOf(" ")+1);
    table=table.substr(0,table.length-1);
    var firstLetter=table.charAt(0);
    table=table.substr(1);
    table=firstLetter+table;
    deleteData(table,id);
});
$(".btnExtend").click(function(){
    var id=$(this).attr('id').substring($(this).attr('id').indexOf("-")+1);
    var table=$(this).attr('class').substring($(this).attr('class').indexOf(" ")+1);
    var url=null;
    if(table=="trips") url="tripPassengers.php";
    else url="passengerTrips.php";
    location.assign(url+"?id="+id);

});
$("#asc").click(function(){
    getData("","asc");
});
$("#desc").click(function(){
    getData("","desc");
});
function getForm(formName,id){
    location.assign(formName+"?id="+id);
}
function deleteData(table,id){
    $.ajax({
        url: "delete"+table+".php",
        data: {
            "id":id
        },
        type: "GET"
    }).done(function(){
        $("tr#"+id).remove();
    });
}

