<?php

$serverName = "localhost";
$userName = "root";
$password = "";
$dbname = "myDb";

$dbc = new mysqli($serverName, $userName, $password);

$dbc->select_db($dbname);
if($dbc->connect_error)
    die("Connection failed". $dbc->connect_error);

$previousType = $_POST['previousType'];
$newType = $_POST['newType'];
$length = $_POST['length'];
$price = $_POST['price'];
$description = $_POST['description'];
$sql = "UPDATE subscriptions
        SET type='$newType', length=$length, price=$price, description='$description'
        WHERE type='$previousType'
        ";

$result = $dbc->query($sql);
if(!$result)
    echo "Error:" . $sql . "<br>" . $dbc->error;

$dbc->close();
