<?php

$serverName = "localhost";
$userName = "root";
$password = "";
$dbname = "myDb";

$dbc = new mysqli($serverName, $userName, $password);

$dbc->select_db($dbname);
if($dbc->connect_error)
    die("Connection failed". $dbc->connect_error);

$title = $_POST['title'];
$isDone = $_POST['isDone'];
$expireDate = $_POST['expireDate'];
$id = $_POST['id'];
$sql = "UPDATE tasks
        SET is_done=$isDone, expire_date='$expireDate', title='$title'
        WHERE id=$id
        ";

$result = $dbc->query($sql);
if(!$result)
    echo "Error:" . $sql . "<br>" . $dbc->error;

$dbc->close();
