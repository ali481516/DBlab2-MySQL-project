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
$sql = "SELECT YEAR(done_date) as y, COUNT(id) as count
        FROM done_tasks_history
        WHERE employee_id=$userId AND done_date BETWEEN CURRENT_DATE - INTERVAL 1 YEAR AND CURRENT_DATE
        GROUP BY y
        ORDER BY y asc";

$result = $dbc->query($sql);

if($result->num_rows > 0){
    $table = $result->fetch_all();
    echo json_encode($table);
}else{
    echo "0 result";
}

$dbc->close();
