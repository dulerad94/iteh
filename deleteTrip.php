<?php
session_start();
require_once "model/model.php";
$id=$_GET['id'];
Model::$trips=unserialize($_SESSION["trips"]);
Model::deleteTrip($id);