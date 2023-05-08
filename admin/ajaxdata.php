<?php

include('../Includes/config.php');

if (isset($_POST['eid'])) {
    $eid = $_POST['eid'];
    $sql = "SELECT DepartmentName,ID FROM `departments` WHERE `ID` = '$eid'";
    $result = $con->query($sql);
    $row = $result->fetch_array();
    echo json_encode($row);
}


if (isset($_POST['pid'])) {
    $pid = $_POST['pid'];
    $sql1 = "SELECT ProjectName,ID FROM `projects` WHERE `ID` = '$pid'";
    $result1 = $con->query($sql1);
    $row = $result1->fetch_array();
    echo json_encode($row);
}


if (isset($_POST['emid'])) {
    $emid = $_POST['emid'];
    $sql1 = "SELECT * FROM employees JOIN departments ON employees.EmployeeDept = departments.ID WHERE employees.Id = '$emid'";
    $result1 = $con->query($sql1);
    $row = $result1->fetch_array();
    echo json_encode($row);
}

if(isset($_POST['TaskId']))
{
    $TaskId = $_POST['TaskId'];
    $sql1 = "SELECT tasks.Id as tid,tasks.*,employees.*,projects.* FROM `tasks` JOIN projects ON projects.ID = tasks.ProjectId JOIN employees ON employees.Id = tasks.AssignTaskto WHERE tasks.Id = $TaskId";
    $result1 = $con->query($sql1);
    $row = $result1->fetch_array();
    echo json_encode($row);
}




//code check Empid
if(isset($_POST["empid"])) {
    $empid=$_POST["empid"];
    $sql ="SELECT `EmployeeUsername` FROM `employees` WHERE `EmployeeUsername` = '$empid'";
    $query = $con->query($sql);
     
    if($query ->num_rows > 0)
    echo "<span style='color:red'> Employee Id already assign to another employee.</span>";
    else
     echo "<span style='color:green'> Employee Id avaialble for registration.</span>";
     
    }