<?php

include('Includes/config.php');
if (!isset($_SESSION['user'])) {
    header('location:Includes/login.php');
    die();
}

include('Includes/sidebar.php');
include('Includes/navbar.php');

$user_id = $_SESSION['user']['Id'];
$data = mysqli_query($con, "SELECT * FROM `departments` WHERE `HOD_id` = $user_id ");
$data = mysqli_fetch_array($data);
$dept = $data['ID'];


if (isset($_POST['AddTask'])) {
    $Deptid = $dept;
    $Empid = $_POST['emplist'];
    $Priority = $_POST['tp'];
    $Projid = $_POST['pname'];
    $Title = $_POST['tt'];
    $Desc = $_POST['td'];
    $Enddate = $_POST['ted'];


    $sql = "INSERT INTO `tasks`(`DeptId`, `AssignTaskto`, `TaskPriority`, `ProjectId`, `TaskTitle`, `TaskDescription`, `TaskEnddate`) VALUES ('$Deptid','$Empid','$Priority','$Projid','$Title','$Desc','$Enddate')";
    $result1 = mysqli_query($con, $sql);
    if ($result1) {
        echo "<script type='text/javascript'> alert('Add Task'); document.location ='ListTask.php'; </script>";
    } else {
        echo "<script>alert('Invalid data');</script>";
    }
}

?>


<title>Task Add - .:: Task Window ::.</title>

<div class="page-header">
    <h3 class="page-title">Add Department</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Department</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Department</li>
        </ol>
    </nav>
</div>
<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <form class="form-sample" method="POST">
                <div class="mt-3">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Department Name</label>
                        <div class="col-sm-10">
                            <input type="text" value="<?= ucwords($data['DepartmentName']) ?>" class="form-control text-dark" disabled>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Employee Name</label>
                        <div class="col-sm-10">
                            <?php
                            include('Includes/config.php');
                            $query = "SELECT * FROM `employees` WHERE `EmployeeDept` = $dept AND `EmployeeRole` = '3'";
                            $query_run = mysqli_query($con, $query);
                            $data1 = mysqli_fetch_assoc($query_run);
                            if ($query_run->num_rows > 0) {
                            ?>
                                <select class=" form-control" type="text" name="emplist" class="form-control" required='true'>
                                    <option>Select Employee</option>
                                    <?php foreach ($query_run as $items) { ?>
                                        <option value="<?= $items['Id'] ?>"><?= $items['EmployeeName'] ?></option>
                                    <?php } ?>
                                </select>
                            <?php
                            } else {
                                echo "Data Not Found";
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Task Priority</label>
                        <div class="col-sm-10">
                            <select type="text" name="tp" class="form-control" required='true'>
                                <option value="">Select Task Priority
                                </option>
                                <option value="Normal">Normal</option>
                                <option value="Medium">Medium</option>
                                <option value="Urgent">Urgent</option>
                                <option value="Most Urgent">Most Urgent
                                </option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Project Name</label>
                        <div class="col-sm-10">
                            <?php
                            include('Includes/config.php');
                            $query = "SELECT * FROM `projects` WHERE `Status` = 0";
                            $query_run = mysqli_query($con, $query);
                            if (mysqli_num_rows($query_run) > 0) {
                            ?>
                                <select class=" form-control" type="text" name="pname" class="form-control" required='true'>
                                    <option>Select Project Name</option>
                                    <?php foreach ($query_run as $items) { ?>
                                        <option value="<?= $items['ID'] ?>"><?= $items['ProjectName'] ?></option>
                                    <?php } ?>
                                </select>
                            <?php
                            } else {
                                echo "Data Not Found";
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Task Title</label>
                        <div class="col-sm-10">
                            <input type="text" name="tt" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Task Description</label>
                        <div class="col-sm-10">
                            <textarea type="text" name="td" class="form-control"></textarea>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Task End Date</label>
                        <div class="col-sm-10">
                            <input type="date" name="ted" class="form-control">
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary mr-2 p-2" name="AddTask">Submit</button>
                    <button type="reset" class="btn btn-dark p-2">Reset</button>
                </div>

            </form>
        </div>
    </div>
</div>



<?php
include('Includes/footer.php');
?>