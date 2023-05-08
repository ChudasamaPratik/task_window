<?php

include('../Includes/config.php');
if (!isset($_SESSION['IS_VALID']) && !isset($_SESSION['user'])) {
    echo "<script type='text/javascript'> document.location ='../login.php'; </script>";;
    die();
}

include('Includes/sidebar.php');
include('Includes/navbar.php');


$q1 = "SELECT ID FROM `departments`";
$q2 = "SELECT `Id` FROM `employees` WHERE flag=  '0'";
$q3 = "SELECT `Status` FROM `projects` WHERE `Status` = 0";

$r1 = $con->query($q1);
$r2 = $con->query($q2);
$r3 = $con->query($q3);

$Departments = mysqli_num_rows($r1);
$Employees = mysqli_num_rows($r2);
$Projects = mysqli_num_rows($r3);
?>

<title>Dashboard - .::Task Window::.</title>

<div class="content-wrapper">

    <div class="row">

        <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0 mt-2 text-muted font-weight-normal">Total Departments</h3>
                            </div>
                        </div>
                        <div class="col-3 mt-1">
                            <div class="icon icon-box-success ">
                                <h3 class="mb-0 "><?= $Departments ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0 mt-2 text-muted font-weight-normal">Total Employees</h3>
                            </div>
                        </div>
                        <div class="col-3 mt-1">
                            <div class="icon icon-box-success ">
                                <h3 class="mb-0 "><?= $Employees ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0 mt-2 text-muted font-weight-normal">Active Project</h3>
                            </div>
                        </div>
                        <div class="col-3 mt-1">
                            <div class="icon icon-box-success ">
                                <h3 class="mb-0 "><?= $Projects ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>



<?php
include('Includes/footer.php');
?>