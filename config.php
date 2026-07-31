<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "pampa_fert";

$conn = new sqlsrv($host, $user, $password, $database);

if($conn->connect_error){
    die("Connection Failed : " . $conn->connect_error);
}

?>