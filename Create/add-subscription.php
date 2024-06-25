<?php

$serverName = "localhost";
$userName = "root";
$password = "";
$dbname = "myDb";

$dbc = new mysqli($serverName, $userName, $password);

$dbc->select_db($dbname);
if($dbc->connect_error)
    die("Connection failed". $dbc->connect_error);

$type = $_POST['type'];
$length = $_POST['length'];
$description = $_POST['description'];
$price = $_POST['price']; 
$sql = "INSERT INTO subscriptions(type, price, length, description)
VALUES('$type', $price, $length, '$description')";

$result = $dbc->query($sql);
if(!$result)
    echo "Error:" . $sql . "<br>" . $dbc->error;

$dbc->close();
