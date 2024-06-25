<?php

$serverName = "localhost";
$userName = "root";
$password = "";
$dbname = "myDb";

$dbc = new mysqli($serverName, $userName, $password);

$dbc->select_db($dbname);
if($dbc->connect_error)
    die("Connection failed". $dbc->connect_error);

$expireDate = $_POST['expireDate'];
$id = $_POST['id'];
$sql = "UPDATE tasks
        SET expire_date='$expireDate'
        WHERE id=$id
        ";

$result = $dbc->query($sql);
if(!$result)
    echo "Error:" . $sql . "<br>" . $dbc->error;

$dbc->close();
