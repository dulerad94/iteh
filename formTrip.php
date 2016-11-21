<?php
session_start();
$txtName=null;
$txtStartDate=null;
$txtEndDate=null;
$ID=null;
$action="insertTrip.php";
$txtButton="Ubaci putovanje";
if(isset($_GET['id']) && ($_GET['id'])!='null' && ($_GET['id']!="")){
    require_once "model/model.php";
    Model::$trips=unserialize($_SESSION["trips"]);
    $ID=$_GET['id'];
    $trip=Model::findTripByID($_GET['id']);
    $txtName=$trip->getName();
    $txtStartDate=$trip->getStartDate();
    $txtEndDate=$trip->getEndDate();
    $txtButton="Izmeni";
    $action="updateTrip.php";
}
?>
<form method="get" action="<?php echo $action;?>">
    <input type="hidden" name="id" value='<?php echo $ID;?>' >
    <p>Naziv</p>
    <input type="text" name="name" value='<?php echo $txtName;?>'>
    <br>
    <p>Datum pocetka</p>
    <input type="date" name="startDate" value='<?php echo $txtStartDate;?>'>
    <br>
    <p>Datum kraja</p>
    <input type="date" name="endDate" value='<?php echo $txtEndDate;?>'>
    <br>
    <input type="submit" value='<?php echo $txtButton;?>'>
</form>

