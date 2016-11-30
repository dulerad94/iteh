<?php

session_start();
$table=null;
$sort=null;
$search=null;
if(isset($_GET['table'])){
    if($_GET['table']=="") $table=$_SESSION["tableName"];
    else $table=$_GET['table'];
    $sort=$_GET['sort'];
}
else if(isset($_GET['search'])){
    $search=$_GET['search'];
    $table=$_SESSION["tableName"];
}
else{
    header("Location: 404.php");
}


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
        $response.="<th>".$row["Field"]."</th>";
}
$response.="</tr>";
$data=Model::loadData($table,$sort);
if($search!=null)
    $data = Model::search($table, $search);
foreach($data as $object) {
    $id=null;
    $vars=$object->asArray();
    $numberOfColumns=sizeof($vars);
    foreach ($vars as $key => $value) {
        if ($key == "$tableSingular"."ID") {
            $id=$value;
            $response .= "<tr id='$id'>";

        }
        $response .= "<td>" . $value . "</td>";
    }
    $response .= "<td><button class='btnExtend $table' id='btnExtend-$id'>Opsirnije</button><button class='btnRemove $table' id='btnRemove-$id'>Obrisi</button><button class='btnChange $table' id='btnChange-$id'>Izmeni</button></td>";
    $response .= "</tr>";
    $response.="<tr><td colspan='$numberOfColumns'><div id='data-$id'></div></td></tr>";
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
$response.="<button id='asc'> Rastuce po imenu</button>";
$response.="<button id='desc'>Opadajuce po imenu</button>";
$response.="<form method='get' action='table.php'><input type='text' name='search'><input type='submit' value='Pretrazi po imenu'></form>";
echo $response;

echo "<script src='js/tableFunctions.js'></script>";
$_SESSION["$table"]=serialize($data);
$_SESSION["tableName"]=$table;