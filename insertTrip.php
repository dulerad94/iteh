<?php

require_once "model/model.php";
$name=trim($_GET['name']);
$startDate=$_GET['startDate'];
$endDate=$_GET['endDate'];
//obradi lepo da ne bude greske prilikom unosa u bazu
Model::insertTrip($name, $startDate, $endDate);
header("Location: index.php");

