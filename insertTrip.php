<?php

require_once "model/model.php";
$name=trim($_GET['name']);
$startDate=$_GET['startDate'];
$endDate=$_GET['endDate'];

Model::insertTrip($name, $startDate, $endDate);
header("Location: index.php");

