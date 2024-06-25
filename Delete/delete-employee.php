<?php

$serverName = "localhost";
$userName = "root";
$password = "";
$dbname = "myDb";

$dbc = new mysqli($serverName, $userName, $password);

$dbc->select_db($dbname);
if($dbc->connect_error)
    die("Connection failed". $dbc->connect_error);

$email = $_GET['email'];
$sql = "DELETE FROM employees
        WHERE email='$email'
        ";

$result = $dbc->query($sql);
if(!$result)
    echo "Error:" . $sql . "<br>" . $dbc->error;

$dbc->close();
