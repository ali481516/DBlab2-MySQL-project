<?php

$serverName = "localhost";
$userName = "root";
$password = "";
$dbname = "myDb";

$dbc = new mysqli($serverName, $userName, $password);

$dbc->select_db($dbname);
if($dbc->connect_error)
    die("Connection failed". $dbc->connect_error);

$date = $_POST['date'];
$id = $_POST['id'];
$sql = "UPDATE done_tasks_history
        SET done_date='$date'
        WHERE id=$id
        ";

$result = $dbc->query($sql);
if(!$result)
    echo "Error:" . $sql . "<br>" . $dbc->error;

$dbc->close();
