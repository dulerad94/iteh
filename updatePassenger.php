<?php
session_start();
require_once "model/model.php";
Model::$passengers=unserialize($_SESSION["passengers"]);
$name=trim($_GET['name']);
$surname=trim($_GET['surname']);
$passportNumber=$_GET['passportNumber'];
$dayOfBirth=$_GET['dayOfBirth'];
$passenger=Model::findPassengerByID($_GET['id']);
$passenger->set($name,$surname,$passportNumber,$dayOfBirth);
$passenger->saveChanges();
header("Location: index.php");