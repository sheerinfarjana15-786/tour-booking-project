<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "travel_db";      

$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_error) {
    die("DB connection failed: " . $mysqli->connect_error);
}
$mysqli->set_charset("utf8mb4");
?>
