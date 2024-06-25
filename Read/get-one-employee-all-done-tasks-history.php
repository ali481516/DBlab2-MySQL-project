<?php

$serverName = "localhost";
$userName = "root";
$password = "";
$dbname = "myDb";

$dbc = new mysqli($serverName, $userName, $password);

$dbc->select_db($dbname);
if($dbc->connect_error)
    die("Connection failed". $dbc->connect_error);

$userId = $_GET['userId'];
$sql = "SELECT *
        FROM done_tasks_history
        WHERE employee_id=$userId
        ";

$result = $dbc->query($sql);

if($result->num_rows > 0){
    $table = $result->fetch_all();
    echo json_encode($table);
}else{
    echo "0 result";
}

$dbc->close();
