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
<title>New Task - .:: Task Window ::.</title>


<div class="page-header">
    <h3 class="page-title">Task</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Task</a></li>
            <li class="breadcrumb-item active" aria-current="page">New Task</li>
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
                       
                        $id = $_SESSION['user']['Id'];
                        $query = "SELECT tasks.Id,ProjectName,TaskTitle,DepartmentName,EmployeeName,TaskAssigndate,TaskEnddate,'Status'  FROM `tasks` JOIN `departments` ON tasks.DeptId = departments.ID  JOIN employees ON tasks.AssignTaskto = employees.Id  JOIN projects ON tasks.ProjectId = projects.ID WHERE tasks.AssignTaskto = '$id' && tasks.Status = 'pending'";
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
                                <?php
                                    if($data['Status'] = "pending")
                                    {
                                        echo "Pending";
                                    }else{
                                        echo $data['Status'];
                                    }
                                ?>
                            </td>
                            <td> <a type="button" class="btn btn-inverse-primary"
                                    href="<?php echo 'ViewTask.php?tid=' . $data['Id']; ?>">View</a> </td>
                        </tr>
                        <?php $number++;  ?>
                        <?php
                            }
                        } else {
                            ?>
                        <tr>
                            <td colspan="9" class="text-center">Record Not Found</td>
                        </tr>
                        <?php
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