<?php

$serverName = "localhost";
$userName = "root";
$password = "";
$dbname = "myDb";

$dbc = new mysqli($serverName, $userName, $password);

$dbc->select_db($dbname);
if($dbc->connect_error)
    die("Connection failed". $dbc->connect_error);

$username = $_POST['username'];
$newEmail = $_POST['newEmail'];
$password = $_POST['password'];
$previousEmail = $_POST['previousEmail'];
$sql = "UPDATE employees
        SET username='$username', email='$newEmail', password=$password
        WHERE email='$previousEmail'
        ";

$result = $dbc->query($sql);
if(!$result)
    echo "Error:" . $sql . "<br>" . $dbc->error;

$dbc->close();
