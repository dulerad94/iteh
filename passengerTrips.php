<?php
session_start();
require_once "model/model.php";
Model::$passengers=unserialize($_SESSION["passengers"]);
if(isset($_GET['id'])) {
    $passengerID=$_GET['id'];
    $passenger = Model::findPassengerByID($passengerID);
    Model::loadPassengerTrips($passenger);

    $response = "<table>";
    $response .= "<tr><th>TripID</th><th>Name</th><th>StartDate</th><th>EndDate</th></tr>";
    $data = Model::$trips;
    foreach ($data as $object) {
        $id = null;
        $vars = $object->asArray();
        foreach ($vars as $key => $value) {
            if ($key == "tripID") {
                $id = $value;
                $response .= "<tr id='$id'>";

            }
            $response .= "<td>" . $value . "</td>";
        }
        $response .="<td><button id='deleteTrip $id'class='deleteTrip'>Obrisi aranzman</button></td>";
        $response .= "</tr>";
    }
    $response .= "</table>";
    echo $response;
    $passengerID=$passenger->getPassengerID();
    echo "<p>Ukucajte ID aranzmana</p><input type='text' id='tripID' ><button id='$passengerID' class='addTrip'>Dodaj aranzman</button>";
    echo "<script src='js/jquery-3.1.1.js.js'></script>";
    echo "<script src='js/tripPassenger.js'></script>";
    $_SESSION["passenger"]=serialize($passenger);
}
?>


