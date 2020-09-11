<?php 

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "bellaria";

$connect = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName) or die("Connection failed!");

?>