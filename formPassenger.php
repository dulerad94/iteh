
<?php
session_start();
$txtName=null;
$txtSurname=null;
$txtPassportNumber=null;
$txtDayOfBirth=null;
$ID=null;
$action="insertPassenger.php";
$txtButton="Prijavi se";
if(isset($_GET['id']) && ($_GET['id'])!='null' && ($_GET['id']!="")){
    require_once "model/model.php";
    Model::$passengers=unserialize($_SESSION["passengers"]);
    $ID=$_GET['id'];
    $passenger=Model::findPassengerByID($_GET['id']);
    $txtName=$passenger->getName();
    $txtSurname=$passenger->getSurname();
    $txtPassportNumber=$passenger->getPassportNumber();
    $txtDayOfBirth=$passenger->getDayOfBirth();
    $txtButton="Izmeni";
    $action="updatePassenger.php";
}
?>
<form method="get" action="<?php echo $action;?>">
    <input type="hidden" name="id" value='<?php echo $ID;?>' >
    <p>Ime</p>
    <input type="text" name="name" value='<?php echo $txtName ?>'>
    <br>
    <p>Prezime</p>
    <input type="text" name="surname" value='<?php echo $txtSurname ?>'>
    <br>
    <p>Broj pasosa</p>
    <input type="text" name="passportNumber" value='<?php echo $txtPassportNumber ?>'>
    <br>
    <p>Datum rodjenja</p>
    <input type="date" name="dayOfBirth" value='<?php echo $txtDayOfBirth ?>'>
    <br>
    <input type="submit" value='<?php echo $txtButton ?>'>
</form>
