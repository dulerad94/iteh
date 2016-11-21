<?php
session_start();
require_once "model/model.php";
Model::$trips=unserialize($_SESSION["trips"]);
$name=trim($_GET['name']);
$startDate=$_GET['startDate'];
$endDate=$_GET['endDate'];
$trip=Model::findTripByID($_GET['id']);
$trip->set($name,$startDate,$endDate);
$trip->saveChanges();
header("Location: index.php");