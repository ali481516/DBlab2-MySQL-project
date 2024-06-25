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
$userId = $_POST['userId'];
$managerId = $_POST['managerId'];
$parentTaskId = $_POST['parentTaskId'];
$sql = "INSERT INTO tasks
        (is_done, title, employee_id, manager_id, flags, parent_task_id)
        VALUE (false, '$title', $userId, $managerId, JSON_ARRAY(), $parentTaskId)";

$result = $dbc->query($sql);
if(!$result)
    echo "Error:" . $sql . "<br>" . $dbc->error;

$dbc->close();
