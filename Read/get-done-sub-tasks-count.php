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
$sql = "SELECT parent_task_id, COUNT(id) as count
        FROM tasks
        WHERE employee_id=$userId AND is_done=1 AND parent_task_id IS NOT NULL
        GROUP BY parent_task_id";

$result = $dbc->query($sql);

if($result->num_rows > 0){
    $table = $result->fetch_all();
    echo json_encode($table);
}else{
    echo "0 result";
}

$dbc->close();
