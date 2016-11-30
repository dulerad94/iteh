<?php

class PassengerTrip{

    private $passenger;
    private $trip;

    function __construct($passengerID,$tripID)
    {
        $this->passenger=Model::findPassengerByID($passengerID);
        $this->trip=Model::findTripByID($tripID);
    }

    public function insertIntoDatabase(){
        global $conn;
        $sql="INSERT INTO passenger_trip(passengerID,tripID) VALUES(".$this->passenger->getPassengerID().",".$this->trip->getTripID().")";
        $conn->query($sql);
    }
    public function deleteFromDatabase(){
        global $conn;
        $sql="DELETE FROM passenger_trip WHERE passengerID=".$this->passenger->getPassengerID()." AND tripID=".$this->trip->getTripID();
        $conn->query($sql);
    }
    public function getPassenger(){
        return $this->passenger;
    }
    public function getTrip(){
        return $this->trip;
    }
}
?>