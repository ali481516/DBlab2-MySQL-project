<?php

$serverName = "localhost";
$userName = "root";
$password = "";
$dbname = "myDb";

$dbc = new mysqli($serverName, $userName, $password);

$dbc->select_db($dbname);
if($dbc->connect_error)
    die("Connection failed". $dbc->connect_error);

$userName = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$sql = "INSERT into employees
        (username, email, password, create_time, subscription_id)
        VALUE ('$userName', '$email', '$password', NOW(), 1)";

$result = $dbc->query($sql);
if(!$result)
    echo "Error:" . $sql . "<br>" . $dbc->error;

$dbc->close();
