<?php
include('../Includes/config.php');
if (!isset($_SESSION['role']) && !isset($_SESSION['user'])) {
    header('location:../login.php');
    die();
    if (strlen($_SESSION['Id'] == 0)) {
        header('location:logout.php');
    }
}

include('Includes/sidebar.php');
include('Includes/navbar.php');
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
        <th colspan="6" style="color: orange;font-weight: bold;font-size: 20px;text-align: center;">
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
        <td colspan="3"><?php echo $row['TaskAssigndate']; ?></td>
    </tr>

    <tr>
        <th>Task Finish Date</th>
        <td colspan="3"><?php echo $row['TaskEnddate']; ?></td>
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
                        echo "Not Response Yet";
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
    $sql = "SELECT * FROM `TaskTracking` WHERE `TaskID` = $tid";
    $query = $con->query($sql);

    if ($query->num_rows > 0) {
        $number = 1;

?>
<table class="table table-bordered dt-responsive nowrap"
    style="color: #000;border-collapse: collapse; border-spacing: 0; width: 100%;">
    <tr align="center">
        <th colspan="5" style="color:white">Task History</th>
    </tr>
    <tr>
        <th>#</th>
        <th>Remark</th>
        <th>Status</th>
        <th>Task Progress</th>
        <th>Time</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($query)) { ?>
    <tr>
        <td><?php echo $number ?></td>
        <td><?php echo $row['Remark']; ?></td>
        <td><?php echo $row['Status']; ?></td>
        <td>
            <span class="skill" style="width:90%;">Task Progress<span
                    class="info_valume"><?php echo $row['WorkCompleted']; ?>%</span>
            </span>

            <div class="progress skill-bar ">
                <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar"
                    aria-valuenow="<?php echo $row['WorkCompleted']; ?>" aria-valuemin="0" aria-valuemax="100"
                    style="width:<?php echo $row['WorkCompleted']; ?>%;">
                </div>
            </div>
        </td>
        <td><?php echo $row['UpdationDate']; ?></td>
    </tr>
    <?php $number++; ?>
    <?php }
        } ?>
</table>


<?php  }
    ?>






<?php
    include('Includes/footer.php');
    ?>