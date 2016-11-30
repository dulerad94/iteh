<?php
require_once "model/model.php";

$tripID=$_GET['tripID'];
$passengerID=$_GET['passengerID'];
Model::loadData("trips","asc");
Model::loadData("passengers","asc");
Model::insertTripPassenger($tripID,$passengerID);
