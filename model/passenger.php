<?php


class Passenger
{
    private $passengerID;
    private $name;
    private $surname;
    private $passportNumber;
    private $dayOfBirth;
    private $trips;


    public function getPassengerID()
    {
        return $this->passengerID;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function getPassportNumber()
    {
        return $this->passportNumber;
    }

    public function getDayOfBirth()
    {
        return $this->dayOfBirth;
    }

    public function getTrips()
    {
        return $this->trips;
    }

    public function asArray(){
        return get_object_vars($this);
    }
    function __construct($passengerID, $name, $surname, $passportNumber, $dayOfBirth){
        $this->passengerID = $passengerID;
        $this->set($name,$surname,$passportNumber,$dayOfBirth);
    }
    public function insertIntoDatabase(){
        if($this->passengerID!=null) return;
        global $conn;
        $sql="INSERT INTO passengers(name,surname,passportNumber,dayOfBirth) VALUES ('".$this->name."','".$this->surname."','".$this->passportNumber."','".$this->dayOfBirth."')";
        $conn->query($sql);
        $this->passengerID=$conn->insert_id;
    }
    public function deleteFromDatabase(){
        global $conn;
        $sql="DELETE FROM passengers WHERE passengerID=$this->passengerID";
        $conn->query($sql);
    }
    public function set($name,$surname,$passportNumber,$dayOfBirth){
        $this->name = $name;
        $this->surname = $surname;
        $this->passportNumber = $passportNumber;
        $this->dayOfBirth = $dayOfBirth;
    }
    public function saveChanges(){
        global $conn;
        $sql="UPDATE passengers SET name='$this->name', surname='$this->surname', passportNumber='$this->passportNumber', dayOfBirth='$this->dayOfBirth' where passengerID=$this->passengerID";
        $conn->query($sql);
    }
    public function addTrip($passengerTrip){
        $this->trips[]=$passengerTrip;
    }
    public function findPassengerTripByID($tripID){
        foreach($this->trips as $passengerTrip){
            if($passengerTrip->getTrip()->getTripID()==$tripID) return $passengerTrip;
        }
    }
}

?>