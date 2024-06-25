<?php

$serverName = "localhost";
$userName = "root";
$password = "";
$dbname = "myDb";

$dbc = new mysqli($serverName, $userName, $password);

$dbc->select_db($dbname);
if($dbc->connect_error)
    die("Connection failed". $dbc->connect_error);

$isDone = $_POST['isDone'];
$id = $_POST['id'];
$sql1 = "UPDATE tasks
        SET is_done=$isDone
        WHERE id=$id
        ";

$result1 = $dbc->query($sql1);
if(!$result1)
    echo "Error:" . $sql1 . "<br>" . $dbc->error;

if($isDone && $result1){
    $sql2 = "SELECT employee_id
            FROM tasks
            WHERE id=$id and parent_task_id IS NULL
            ";

    $result2 = $dbc->query($sql2);
    if($result2->num_rows > 0){
        $table = $result2->fetch_all();
        $userId = $table[0][0];
        $sql3 = "INSERT INTO done_tasks_history(done_date, employee_id)
                VALUES(CURRENT_DATE(), $userId)
                ";
        
        $sql4 = "DELETE FROM tasks
                WHERE id=$id
                ";

        $result3 = $dbc->query($sql3);
        $result4 = $dbc->query($sql4);
        if(!$result3)
            echo "Error:" . $sql3 . "<br>" . $dbc->error;
        if(!$result4)
            echo "Error:" . $sql4 . "<br>" . $dbc->error;
    }else{
        echo "sub task done";
    }
}

$dbc->close();
