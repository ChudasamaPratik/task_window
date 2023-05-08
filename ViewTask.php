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


if (isset($_POST['TaskUpdate'])) {

    $tid = $_GET['tid'];
    $status = $_POST['status'];
    $remark = $_POST['remark'];
    $WorkCompleted = $_POST['workcom'];

    $sql = "INSERT INTO `tasktracking`(`TaskID`, `Remark`, `Status`, `WorkCompleted`) VALUES ('$tid','$remark','$status','$WorkCompleted')";
    $con->query($sql);

    $sql1 = "UPDATE `tasks` SET `Status`='$status',`WorkCompleted`='$WorkCompleted',`Remark`='$remark' WHERE `Id` = $tid";
    $con->query($sql1);

    echo '<script>alert("Remark has been updated")</script>';
    echo "<script>window.location.href ='AllTask.php'</script>";
}

?>
<title>Detail Task View - .:: Task Window ::.</title>

<style>
    td,
    th {
        color: white;
    }
</style>

<div class="page-header">
    <h3 class="page-title">View Task</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Task</a></li>
            <li class="breadcrumb-item active" aria-current="page">View Task</li>
        </ol>
    </nav>
</div>
<?php
$tid = $_GET['tid'];
$sql = "SELECT * FROM `tasks` JOIN departments ON departments.ID = tasks.DeptId JOIN employees ON employees.Id = tasks.AssignTaskto WHERE tasks.Id = $tid";
$result = $con->query($sql);

if ($result->num_rows > 0) {

    while ($row = mysqli_fetch_assoc($result)) {

?>
        <table class="table table-bordered" style="color:#000">
            <tr>
                <th colspan="6" style="color: orange;font-weight: bold;font-size: 18px;text-align: center;">
                    Task Details </th>
            </tr>

            <tr>
                <th>Task Title</th>
                <td><?php echo $row['TaskTitle']; ?></td>
                <th>Task Priority</th>
                <td><?php echo $row['TaskPriority']; ?></td>
            </tr>

            <tr>
                <th>Task Description</th>
                <td colspan="3"><?php echo $row['TaskDescription']; ?></td>
            </tr>

            <tr>
                <th>Task Assign Date</th>
                <td colspan="3"><?= date("d-m-Y h:i:s", strtotime($row['TaskAssigndate'])) ?></td>
            </tr>

            <tr>
                <th>Task Finish Date</th>
                <td colspan="3"><?= date("d-m-Y", strtotime($row['TaskEnddate'])) ?></td>
            </tr>

            <tr>

                <th>Employee Final Remark</th>
                <td colspan="4"><?php echo ($row['Status'] == 0) ? 'Not Updated Yet' : $row['Remark']; ?></td>
            </tr>

            <tr>

                <th>Task Final Status</th>
                <td colspan="3">
                    <?php
                    $status = $row['Status'];
                    if ($row['Status'] == "Inprogress") {
                        echo "In Progress";
                    }

                    if ($row['Status'] == "Completed") {
                        echo "Completed";
                    }


                    if ($row['Status'] == "pending") {
                        echo "Pending";
                    };
                    ?>
                </td>


            </tr>
        </table>
<?php
    }
}
?>




<?php
$tid = $_GET['tid'];
if ($status != "") {
    $sql = "SELECT * FROM `TaskTracking` WHERE TaskID = $tid";
    $query = $con->query($sql);

    if ($query->num_rows > 0) {
        $number = 1;

?>
        <table class="table table-bordered dt-responsive nowrap" style="color: #000;border-collapse: collapse; border-spacing: 0; width: 100%;">
            <tr>
                <th colspan="6" style="color: orange;font-weight: bold;font-size: 18px;text-align: center;">
                    Task History
                </th>
            </tr>
            <tr>
                <th>#</th>
                <th>Remark</th>
                <th>Status</th>
                <th>Task Progress History</th>
                <th>Progress Time</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                <tr>
                    <td><?php echo $number ?></td>
                    <td><?php echo $row['Remark']; ?></td>
                    <td><?php echo $row['Status']; ?></td>
                    <td>
                        <span class="skill" style="width:90%;">Task Progress&nbsp;&nbsp;<span class="info_valume"><?php echo $row['WorkCompleted']; ?>%</span>
                        </span>

                        <div class="progress skill-bar ">
                            <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" aria-valuenow="<?php echo $row['WorkCompleted']; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $row['WorkCompleted']; ?>%;">
                            </div>
                        </div>
                    </td>
                    <td><?= date("d-m-Y h:i:s", strtotime($row['UpdationDate'])) ?></td>
                </tr>
        <?php }
            $number++;
        } ?>
        </table>


    <?php  }
    ?>




    <?php

    if ($status == "pending" || $status == "Inprogress") {
    ?>
        <p align="center" style="padding-top: 20px">
            <button class="btn btn-inverse-primary" data-toggle="modal" data-target="#myModal">Take
                Action</button>
        </p>

    <?php } ?>


    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width:150%">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Take Action
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form method="post">
                    <div class="row mb-1">
                        <div class="col-6">
                            <label for="" class="form-label">Remark :</label>
                        </div>
                        <div class="col-6">
                            <textarea name="remark" placeholder="Remark" rows="12" cols="14" class="form-control wd-450" required="true"></textarea>
                        </div>
                    </div>

                    <div class="row mb-1">
                        <div class="col-6">
                            <label for="" class="form-label">Work Completion(in percentage) :</label>
                        </div>
                        <div class="col-6">
                            <input name="workcom" placeholder="Work Completion in percentage (Eg: 20)" pattern="[0-9]+" title="only numbers" rows="12" cols="14" class="form-control wd-450" required="true">
                        </div>
                    </div>

                    <div class="row mb-1">
                        <div class="col-6">
                            <label for="" class="form-label">Status :</label>
                        </div>
                        <div class="col-6">
                            <select name="status" class="form-control wd-450" required="true">
                                <option value="Inprogress" selected="true">Inprogress</option>
                                <option value="Completed">Completed
                                </option>
                            </select>   
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="TaskUpdate" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>






    <?php
    include('Includes/footer.php');
    ?>