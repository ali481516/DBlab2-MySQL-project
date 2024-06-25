<?php

$serverName = "localhost";
$userName = "root";
$password = "";
$dbname = "myDb";

$dbc = new mysqli($serverName, $userName, $password);

$dbc->select_db($dbname);
if($dbc->connect_error)
    die("Connection failed". $dbc->connect_error);

$sql = "SELECT username, COUNT(done_tasks_history.id) as done_tasks_count
        FROM done_tasks_history
        INNER JOIN employees ON employees.id=done_tasks_history.employee_id
        WHERE done_date BETWEEN CURRENT_DATE - INTERVAL 1 WEEK AND CURRENT_DATE
        GROUP BY username
        ORDER BY done_tasks_count DESC
        LIMIT 3";

$result = $dbc->query($sql);

if($result->num_rows > 0){
    $table = $result->fetch_all();
    echo json_encode($table);
}else{
    echo "0 result";
}

$dbc->close();
