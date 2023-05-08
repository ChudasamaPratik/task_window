<?php

include('Includes/config.php');
if (!isset($_SESSION['role']) && !isset($_SESSION['user'])) {
    header('location:login.php');
    die();
    if (strlen($_SESSION['Id'] == 0)) {
        header('location:logout.php');
    }
}

include('Includes/sidebar.php');
include('Includes/navbar.php');
?>

<title>Inprogress Task List - .:: Task Window ::.</title>

<div class="page-header">
    <h3 class="page-title">Task</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Task</a></li>
            <li class="breadcrumb-item active" aria-current="page">Inprogress Task</li>
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
                        
                        $gid = $_SESSION['user']['Id'];
                        $query = "SELECT tasks.Id as t, tasks.*,tasks.Status as sta,departments.*,projects.*,EmployeeName FROM `tasks` JOIN `departments` ON departments.ID = tasks.DeptId JOIN employees ON employees.Id = tasks.AssignTaskto JOIN projects ON tasks.ProjectId = projects.ID WHERE tasks.AssignTaskto = '$gid' && tasks.Status = 'Inprogress'";
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
                                <?php echo ($data['sta'] == "pending") ? 'Not Updated Yet' : $data['sta']; ?>
                            </td>
                            <td> <a type="button" class="btn btn-inverse-primary"
                                    href="<?php echo 'ViewTask.php?tid=' . $data['t']; ?>">View</a> </td>
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