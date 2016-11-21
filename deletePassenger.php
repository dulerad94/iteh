<?php
session_start();
require_once "model/model.php";
$id=$_GET['id'];
Model::$passengers=unserialize($_SESSION["passengers"]);
Model::deletePassenger($id);