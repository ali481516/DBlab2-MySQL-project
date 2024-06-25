<?php

$serverName = "localhost";
$userName = "root";
$password = "";
$dbname = "myDb";

$dbc = new mysqli($serverName, $userName, $password);

$dbc->select_db($dbname);
if($dbc->connect_error)
    die("Connection failed". $dbc->connect_error);

$previousFlag = $_POST['previousFlag'];
$newFlag = $_POST['newFlag'];
$id = $_POST['id'];
$sql = "UPDATE tasks
        SET flags = JSON_REPLACE(
        flags,
        JSON_UNQUOTE(
            JSON_SEARCH(flags, 'one', '$previousFlag')
        ),
        '$newFlag'
    )
WHERE id = $id";

$result = $dbc->query($sql);
if(!$result)
    echo "Error:" . $sql . "<br>" . $dbc->error;

$dbc->close();
