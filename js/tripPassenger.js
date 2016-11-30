

$(".addTrip").click(function(){
    var passengerID=$(this).attr('id');
    var tripID=$("#tripID").val();
    $.ajax({
        url: "insertPassengerTrip.php",
        data: {
            "tripID":tripID,
            "passengerID":passengerID
        },
        type: "GET"
    }).done(function(){
        location.assign("passengerTrips.php?id="+passengerID);
    });
});


$(".addPassenger").click(function () {
    var tripID=$(this).attr('id');
    var passengerID=$("#passengerID").val();
    $.ajax({
        url: "insertPassengerTrip.php",
        data: {
            "tripID":tripID,
            "passengerID":passengerID
        },
        type: "GET"
    }).done(function(){
        location.assign("tripPassengers.php?id="+tripID);
    });
});
$(".deletePassenger").click(function(){
    var passengerID=$(this).attr('id');
    passengerID=passengerID.substr(passengerID.indexOf(" ")+1);

    $.ajax({
        url: "deletePassengerTrip.php",
        data: {

            "passengerID":passengerID
        },
        type: "GET"
    }).done(function(){
        $("tr#"+passengerID).remove();
    });
});

$(".deleteTrip").click(function () {
    var tripID=$(this).attr('id');
    tripID=tripID.substr(tripID.indexOf(" ")+1);

    $.ajax({
        url: "deletePassengerTrip.php",
        data: {
            "tripID":tripID

        },
        type: "GET"
    }).done(function(){
        $("tr#"+tripID).remove();
    });
})