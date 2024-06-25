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
$sql = "INSERT into managers
        (username, email, password, create_time)
        VALUE ('$userName', '$email', '$password', NOW())";

$result = $dbc->query($sql);
if(!$result)
    echo "Error:" . $sql . "<br>" . $dbc->error;

$dbc->close();
