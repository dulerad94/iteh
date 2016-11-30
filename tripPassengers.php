<?php
session_start();
require_once "model/model.php";
Model::$trips=unserialize($_SESSION["trips"]);
if(isset($_GET['id'])) {
    $tripID=$_GET['id'];
    $trip = Model::findTripByID($tripID);
    Model::loadTripPassengers($trip);

    $response = "<table>";
    $response .= "<tr><th>PassengerID</th><th>Name</th><th>Surname</th><th>PassportNumber</th><th>DayOfBirth</th></tr>";
    $data = Model::$passengers;
    foreach ($data as $object) {
        $id = null;
        $vars = $object->asArray();
        foreach ($vars as $key => $value) {
            if ($key == "passengerID") {
                $id = $value;
                $response .= "<tr id='$id'>";

            }
            $response .= "<td>" . $value . "</td>";
        }
        $response .="<td><button id='deletePassenger $id' class='deletePassenger $id'>Obrisi putnika</button></td>";
        $response .= "</tr>";

    }
    $response .= "</table>";
    echo $response;
    $tripID=$trip->getTripID();
    echo "<p>Ukucajte ID putnika</p><input id='passengerID' type='text'><button id='$tripID' class='addPassenger'>Dodaj putnika</button>";
    echo "<script src='js/jquery-3.1.1.js.js'></script>";
    echo "<script src='js/tripPassenger.js'></script>";
    $_SESSION["trip"]=serialize($trip);
}


?>

