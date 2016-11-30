

<?php
require_once "trip.php";
require_once "passenger.php";
require_once "connection.php";
require_once "passenger-trip.php";


class Model{
    public static $trips=array();
    public static $passengers=array();

    public static function loadData($data,$sort){
        switch($data){
            case "trips":{
                self::loadAllTrips($sort);
                return self::$trips;

            }
            case "passengers":{
                self::loadAllPassengers($sort);
                return self::$passengers;
            }
            default:{
                header("Location: 404.php");
                break;
            }
        }
    }
    public static function search($table,$text){
        switch($table){
            case "trips":{
                return self::searchTrips($text);


            }
            case "passengers":{
                return self::searchPassengers($text);
            }
            default:{
                header("Location: 404.php");
                break;
            }
        }
    }
    private static function loadAllTrips($sort){
        global $conn;
        if($sort==null) $sort="asc";
        $sql = "SELECT * from trips ORDER BY name $sort";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                self::$trips[$row["tripID"]]=new Trip($row["tripID"],$row["name"],$row["startDate"],$row["endDate"]);
            }
        }
    }
    private static function loadAllPassengers($sort){
        global $conn;
        if($sort==null) $sort="asc";
        $sql = "SELECT * from passengers ORDER BY name $sort";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                self::$passengers[$row["passengerID"]]=new Passenger($row["passengerID"],$row["name"],$row["surname"],$row["passportNumber"],$row["dayOfBirth"]);
            }
        }
    }
    public static function  insertTrip($name,$startDate,$endDate){
        $trip=new Trip(null,$name,$startDate,$endDate);
        $trip->insertIntoDatabase();
    }
    public static function  insertPassenger($name,$surname,$passportNumber,$dayOfBirth){
        $passenger=new Passenger(null,$name,$surname,$passportNumber,$dayOfBirth);
        $passenger->insertIntoDatabase();
    }
    public static function deleteTrip($id){
        $trip=self::findTripByID($id);
        $trip->deleteFromDatabase();
        self::$trips[$id]=null;
    }
    public static function deletePassenger($id){
        $passenger=self::findPassengerByID($id);
        $passenger->deleteFromDatabase();
        self::$passengers[$id]=null;
    }
    public static function findTripByID($id){
        if($id==null) return;
        foreach(self::$trips as $trip){
            if($trip->getTripID()==$id) return $trip;
        }
    }
    public static function findPassengerByID($id){
        if($id==null) return;
        foreach(self::$passengers as $passenger){
            if($passenger->getPassengerID()==$id) return $passenger;
        }
    }
    private static function searchTrips($text){
        $trips=array();
        foreach(self::$trips as $trip){
            if(strpos($trip->getName(),$text)!==false){
                $trips[]=$trip;
            }
        }
        return $trips;
    }
    private static function searchPassengers($text){
        $passengers=array();
        foreach(self::$passengers as $passenger){
            if(strpos($passenger->getName(),$text)!==false){
                $passengers[]=$passenger;
            }
        }
        return $passengers;
    }
    public static function  loadPassengerTrips($passenger){
        global $conn;

        $sql='SELECT * from trips JOIN passenger_trip USING(tripID) WHERE passengerID='.$passenger->getPassengerID();
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                self::$trips[$row["tripID"]]=new Trip($row["tripID"],$row["name"],$row["startDate"],$row["endDate"]);
                $passTrip=new PassengerTrip($passenger->getPassengerID(),$row["tripID"]);
                $passenger->addTrip($passTrip);
            }
        }
    }
    public static function  loadTripPassengers($trip){
        global $conn;
        $sql = 'SELECT * from passengers JOIN passenger_trip USING(passengerID) WHERE tripID='.$trip->getTripID();
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                self::$passengers[$row["passengerID"]]=new Passenger($row["passengerID"],$row["name"],$row["surname"],$row["passportNumber"],$row["dayOfBirth"]);
                $passTrip=new PassengerTrip($row['passengerID'],$trip->getTripID());
                $trip->addPassenger($passTrip);
            }
        }
    }
    public static function insertTripPassenger($tripID,$passengerID){
        $passTrip=new PassengerTrip($passengerID,$tripID);
        $passTrip->insertIntoDatabase();
    }
}

?>