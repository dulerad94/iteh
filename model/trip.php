<?php
require_once "connection.php";
class Trip{
    private $tripID;
    private $name;
    private $startDate;
    private $endDate;
    private $passengers;


    public function getTripID()
    {
        return $this->tripID;
    }


    public function getName()
    {
        return $this->name;
    }


    public function getStartDate()
    {
        return $this->startDate;
    }


    public function getEndDate()
    {
        return $this->endDate;
    }


    public function getPassengers()
    {
        return $this->passengers;
    }

    public function asArray(){
        return get_object_vars($this);
    }

    function __construct($tripID,$name,$startDate,$endDate)
    {
        $this->tripID=$tripID;
        $this->set($name,$startDate,$endDate);
    }
    public function insertIntoDatabase()
    {
        if($this->tripID!=null) return;
        global $conn;
        $sql="INSERT INTO trips(name,startDate,endDate) VALUES('".$this->name."','".$this->startDate."','"."$this->endDate')";
        $conn->query($sql);
        $this->tripID=$conn->insert_id;
    }
    public function deleteFromDatabase(){
        global $conn;
        $sql="DELETE FROM trips WHERE tripID=$this->tripID";
        $conn->query($sql);
    }
    public function set($name,$startDate,$endDate){
        $this->name=$name;
        $this->startDate=$startDate;
        $this->endDate=$endDate;
    }
    public function saveChanges(){
        global $conn;
        $sql="UPDATE trips SET name='$this->name',startDate='$this->startDate',endDate='$this->endDate' where tripID=$this->tripID";
        $conn->query($sql);
    }



}
?>