<?php

include('Includes/config.php');
if (!isset($_SESSION['user'])) {
    header('location:login.php');
    die();
}

include('Includes/sidebar.php');
include('Includes/navbar.php');

$id = $_SESSION['user']['Id'];

//Start For Employee Dashboard
$q1 = "SELECT * FROM `tasks` WHERE Status = 'pending' && AssignTaskto = '$id'";
$q2 = "SELECT * FROM `tasks` WHERE Status = 'Inprogress' && AssignTaskto = '$id'";
$q3 = "SELECT * FROM `tasks` WHERE Status = 'Completed' && AssignTaskto = '$id'";
$q4 = "SELECT * FROM `tasks` WHERE AssignTaskto = '$id'";

$r1 = $con->query($q1);
$r2 = $con->query($q2);
$r3 = $con->query($q3);
$r4 = $con->query($q4);

$row = mysqli_num_rows($r1);
$row2 = mysqli_num_rows($r2);
$row3 = mysqli_num_rows($r3);
$row4 = mysqli_num_rows($r4);

//End For Employee Dashboard
?>

<title>Dashboard - .:: Task Window ::.</title>


<div class="content-wrapper">


    <?php
    if ($_SESSION['user']['EmployeeRole'] == 3) {
    ?>
        <!-- For Employee -->
        <div class="row">
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0 mt-2 text-muted font-weight-normal">New Task</h3>
                                </div>
                            </div>
                            <div class="col-3 mt-1">
                                <div class="icon icon-box-success ">
                                    <h3 class="mb-0 "><?= $row ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0 mt-2 text-muted font-weight-normal">Inprogress Task</h3>
                                </div>
                            </div>
                            <div class="col-3 mt-1">
                                <div class="icon icon-box-success ">
                                    <h3 class="mb-0 "><?= $row2 ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0 mt-2 text-muted font-weight-normal">Completed Task</h3>
                                </div>
                            </div>
                            <div class="col-3 mt-1">
                                <div class="icon icon-box-success ">
                                    <h3 class="mb-0 "><?= $row3 ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0 mt-2 text-muted font-weight-normal">All Task</h3>
                                </div>
                            </div>
                            <div class="col-3 mt-1">
                                <div class="icon icon-box-success ">
                                    <h3 class="mb-0 "><?= $row4 ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>






    <!-- For HOD -->
    <?php
    $user_id = $_SESSION['user']['Id'];
    if ($_SESSION['user']['EmployeeRole'] == 2) {

        //Start For HOD Dashboard

        $data = mysqli_query($con, "SELECT * FROM `departments` WHERE `HOD_id` = $id ");
        $data = mysqli_fetch_array($data);
        $dept = $data['ID'];

        $q10 = "SELECT * FROM employees JOIN departments ON employees.EmployeeDept = departments.ID WHERE departments.HOD_id = '$id' AND employees.EmployeeRole = 3 AND employees.flag = 0";
        $q20 = "SELECT * FROM `tasks` JOIN `departments` ON departments.ID = tasks.DeptId JOIN employees ON employees.Id = tasks.AssignTaskto JOIN projects ON tasks.ProjectId = projects.ID WHERE tasks.Status = 'Inprogress' AND employees.EmployeeDept = $dept";
        $q30 = "SELECT * FROM `tasks` JOIN `departments` ON departments.ID = tasks.DeptId JOIN employees ON employees.Id = tasks.AssignTaskto JOIN projects ON tasks.ProjectId = projects.ID WHERE tasks.Status = 'Completed' AND employees.EmployeeDept = $dept";
        $q40 = "SELECT * FROM `tasks` JOIN `departments` ON departments.ID = tasks.DeptId JOIN employees ON employees.Id = tasks.AssignTaskto JOIN projects ON tasks.ProjectId = projects.ID WHERE  employees.EmployeeDept = $dept";

        $r10 = $con->query($q10);
        $data = mysqli_fetch_array($r10);
        $r20 = $con->query($q20);
        $r30 = $con->query($q30);
        $r40 = $con->query($q40);

        $row0 = mysqli_num_rows($r10);
        $row20 = mysqli_num_rows($r20);
        $row30 = mysqli_num_rows($r30);
        $row40 = mysqli_num_rows($r40);

        //End For HOD Dashboard

    ?>
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card text-center">
                    <h3 class="m-2 text-muted font-weight-normal">Department Of <?= ucwords($data['DepartmentName']) ?></h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0 mt-2 text-muted font-weight-normal">Total Employee</h3>
                                </div>
                            </div>
                            <div class="col-3 mt-1">
                                <div class="icon icon-box-success ">
                                    <h3 class="mb-0 "><?= $row0 ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0 mt-2 text-muted font-weight-normal">Total Inprogress Task</h3>
                                </div>
                            </div>
                            <div class="col-3 mt-1">
                                <div class="icon icon-box-success ">
                                    <h3 class="mb-0 "><?= $row20 ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0 mt-2 text-muted font-weight-normal">Completed Task</h3>
                                </div>
                            </div>
                            <div class="col-3 mt-1">
                                <div class="icon icon-box-success ">
                                    <h3 class="mb-0 "><?= $row30 ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0 mt-2 text-muted font-weight-normal">All Task</h3>
                                </div>
                            </div>
                            <div class="col-3 mt-1">
                                <div class="icon icon-box-success ">
                                    <h3 class="mb-0 "><?= $row40 ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>



<?php
include('Includes/footer.php');
?>