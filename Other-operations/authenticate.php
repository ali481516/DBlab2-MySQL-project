<?php

$serverName = "localhost";
$userName = "root";
$password = "";
$dbname = "myDb";

$dbc = new mysqli($serverName, $userName, $password);

$dbc->select_db($dbname);
if($dbc->connect_error)
    die("Connection failed". $dbc->connect_error);

$userName = $_POST['userName'];
$password = $_POST['password'];
$sql = "SELECT username, password
        FROM employees
        WHERE username='$userName' AND password=$password";

$result = $dbc->query($sql);

if($result->num_rows > 0){
    echo "Authenticated";
}else{
    echo "Not Authenticated";
}

$dbc->close();
