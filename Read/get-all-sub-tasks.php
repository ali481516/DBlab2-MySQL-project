<?php

$serverName = "localhost";
$userName = "root";
$password = "";
$dbname = "myDb";

$dbc = new mysqli($serverName, $userName, $password);

$dbc->select_db($dbname);
if($dbc->connect_error)
    die("Connection failed". $dbc->connect_error);

$parentTaskId = $_GET['parentTaskId'];
$sql = "WITH RECURSIVE TaskHierarchy AS (
        -- Anchor member: Retrieve the root manager
        SELECT *
        FROM tasks
        WHERE parent_task_id = $parentTaskId

        UNION ALL

        -- Recursive member: Retrieve employees reporting to each manager
        SELECT t.*
        FROM tasks t
        JOIN TaskHierarchy th ON t.parent_task_id = th.id
        )
        SELECT *
        FROM taskHierarchy";

$result = $dbc->query($sql);

if($result->num_rows > 0){
    $table = $result->fetch_all();
    echo json_encode($table);
}else{
    echo "0 result";
}

$dbc->close();
