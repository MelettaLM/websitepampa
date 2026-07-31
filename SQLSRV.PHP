<?php

$serverName = "localhost\SQLEXPRESS"; 
$connectionOptions = array(
    "Database" => "pampa_fert",
    "Uid" => "FOOLBABY\USER",
    "PWD" => "your_sql_password"
);

$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

?>