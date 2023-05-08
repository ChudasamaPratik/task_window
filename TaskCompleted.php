<?php

include('Includes/config.php');
if (!isset($_SESSION['IS_VALID']) && !isset($_SESSION['user'])) {
    header('location:login.php');
    die();
}

include('Includes/sidebar.php');
include('Includes/navbar.php');

$user_id = $_SESSION['user']['Id'];
$data = mysqli_query($con, "SELECT * FROM `departments` WHERE `HOD_id` = $user_id ");
$data = mysqli_fetch_array($data);
$dept = $data['ID'];
?>

<title>Completed Task List - .:: Task Window ::.</title>



<div class="page-header">
    <h3 class="page-title">Task Status</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Task Status</a></li>
            <li class="breadcrumb-item active" aria-current="page">Completed Task</li>
        </ol>
    </nav>
</div>


<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> Project Name</th>
                            <th> Task Title</th>
                            <th> Department Name</th>
                            <th> Assign To</th>
                            <th> Assign Date</th>
                            <th> End Date</th>
                            <th> Status</th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                       
                        $query = "SELECT tasks.Id as t,tasks.Status as ts, tasks.*,departments.*,projects.*,EmployeeName FROM `tasks` JOIN `departments` ON departments.ID = tasks.DeptId JOIN employees ON employees.Id = tasks.AssignTaskto JOIN projects ON tasks.ProjectId = projects.ID WHERE tasks.Status = 'completed' AND employees.EmployeeDept = $dept";
                        $result = mysqli_query($con, $query);
                        if (mysqli_num_rows($result) > 0) {
                            $number = 1;
                            while ($data = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?= $number ?></td>
                            <td><?= strtoupper($data['ProjectName']) ?></td>
                            <td><?= $data['TaskTitle'] ?></td>
                            <td><?= $data['DepartmentName'] ?></td>
                            <td><?= $data['EmployeeName'] ?></td>
                            <td><?= $data['TaskAssigndate'] ?></td>
                            <td><?= $data['TaskEnddate'] ?></td>
                            <td>
                                <?php if ($data['ts'] == "pending") {
                                            echo 'Not Updated Yet';
                                        } else {
                                            echo $data['ts'];
                                        } ?>
                            </td>
                            <td> <a type="button" class="btn btn-inverse-primary"
                                    href="<?php echo 'TaskView.php?tid=' . $data['t']; ?>">View</a> </td>
                        </tr>
                        <?php $number++;  ?>
                        <?php
                            }
                        }
                        else
                        {
                            echo "<td colspan='9' class='text-center'>Data Not Found</td>"; 
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>









<?php
include('Includes/footer.php');
?>