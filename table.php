<?php
$table=null;

if(isset($_GET['table'])){
    $table=$_GET['table'];
}
else{
    header("Location: 404.php");
}
session_start();
require_once 'connection.php';
require_once "model/model.php";

$tableSingular=trim($table,'s');
$form="form".ucfirst($tableSingular).".php";
global $conn;
$response="";
$sql="SHOW columns FROM ".$table ;
$columns=$conn->query($sql);
$response.="<table>";
$response.="<tr>";
    while($row = $columns->fetch_assoc()) {
        if($row["Field"]=="$tableSingular"."ID") continue;
        $response.="<th>".$row["Field"]."</th>";
}
$response.="</tr>";
$data=Model::loadData($table);

foreach($data as $object) {
    $id=null;
    $vars=$object->asArray();
    foreach ($vars as $key => $value) {
        if ($key == "$tableSingular"."ID") {
            $id=$value;
            $response .= "<tr id='$id'>";
            continue;
        }
        $response .= "<td>" . $value . "</td>";
    }
    $response .= "<td><button>Rasiri</button><button class='btnRemove $table' id='btnRemove-$id'>Obrisi</button><button class='btnChange $table' id='btnChange-$id'>Izmeni</button></td>";
    $response .= "</tr>";
}
$response.="</table>";
switch($table){
    case "trips":{
        $response.="<button id='addTrip'>Dodaj aranzman</button>";
        break;
    }
    case "passengers":{
        $response.="<button id='addPassenger'>Dodaj putnika</button>";
        break;
    }

}
echo $response;

echo "<script src='js/tableFunctions.js'></script>";
$_SESSION["$table"]=serialize($data);
