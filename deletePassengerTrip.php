<?php
session_start();
require_once "model/model.php";
$trip=null;
$passenger=null;
if(isset($_SESSION["trip"])){
    $trip=unserialize($_SESSION["trip"]);
    $passengerID=$_GET['passengerID'];
    Model::loadTripPassengers($trip);
    $passengerTrip=$trip->findPassengerTripByID($passengerID);
    $passengerTrip->deleteFromDatabase();

}else if(isset($_SESSION["passenger"])) {
    $passenger=unserialize($_SESSION['passenger']);
    $tripID=$_GET['tripID'];
    Model::loadPassengerTrips($passenger);
    $passengerTrip=$passenger->findPassengerTripByID($tripID);
    $passengerTrip->deleteFromDatabase();
}else{
    header("Location: index.php");
}





