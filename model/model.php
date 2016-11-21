

<?php
require_once "trip.php";
require_once "passenger.php";
require_once "connection.php";
class Model{
    public static $trips=array();
    public static $passengers=array();

    public static function loadData($data){
        switch($data){
            case "trips":{
                self::loadAllTrips();
                return self::$trips;

            }
            case "passengers":{
                self::loadAllPassengers();
                return self::$passengers;
            }
            default:{
                header("Location: 404.php");
                break;
            }
        }
    }
    private static function loadAllTrips(){
        global $conn;
        $sql = "SELECT * from trips";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                self::$trips[$row["tripID"]]=new Trip($row["tripID"],$row["name"],$row["startDate"],$row["endDate"]);
            }
        }
    }
    private static function loadAllPassengers(){
        global $conn;
        $sql = "SELECT * from passengers";
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

}

?>