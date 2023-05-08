<?php
$con = new mysqli("localhost", "root", "", "task_window");

// Check connection
if ($con->connect_errno) {
    echo "Failed to connect to MySQL: " . $con->connect_error;
    exit();
}


if (!isset($_SESSION)) {
    session_start();
}