<?php
require_once "model/model.php";
$name=trim($_GET['name']);
$surname=trim($_GET['surname']);
$passportNumber=$_GET['passportNumber'];
$dayOfBirth=$_GET['dayOfBirth'];
//obradi lepo da ne bude greske prilikom unosa u bazu
Model::insertPassenger($name,$surname,$passportNumber,$dayOfBirth);
header("Location: index.php");
