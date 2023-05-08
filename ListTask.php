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

if (isset($_POST['TaskUpdate'])) {
    $id = $_POST['TaskId'];
    $Employee = $_POST['emplist'];
    $TaskPriority = $_POST['tp'];
    $ProjectName = $_POST['pname'];
    $TaskTitle = $_POST['tt'];
    $TaskDescription = $_POST['td'];
    $TaskEnd = $_POST['ted'];

    $sql = "UPDATE `tasks` SET `AssignTaskto`='$Employee',`TaskPriority`='$TaskPriority',`ProjectId`='$ProjectName',`TaskTitle`='$TaskTitle',`TaskDescription`='$TaskDescription',`TaskEnddate`='$TaskEnd' WHERE `Id`='$id'";

    $result = mysqli_query($con, $sql);
    if ($result == TRUE) {
        echo "<script type='text/javascript'> alert('Task Updated..'); document.location ='ListTask.php'; </script>";
    } else {
        echo "<script>alert('Error in Task Updatetion.');</script>";
    }
}
?>

<title>All Task List - .:: Task Window ::.</title>



<!-- Modal -->
<div class="modal fade" id="dept" tabindex="-1" aria-labelledby="dept" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel">Update Task</h3>
            </div>
            <div class="modal-body">

                <form class="form-sample" method="POST">
                    <div class="mt-3">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Department Name</label>
                            <div class="col-sm-10">
                                <input type="hidden" name="TaskId" id="TaskIt">
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
                                $query = "SELECT * FROM `employees` WHERE `EmployeeDept` = $dept AND `EmployeeRole` = '3' AND `flag` = 0";
                                $query_run = mysqli_query($con, $query);
                                $data1 = mysqli_fetch_assoc($query_run);
                                if ($query_run->num_rows > 0) {
                                ?>
                                    <select class=" form-control" name="emplist" class="form-control" required='true' id="EmployeeName">
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
                                <select type="text" name="tp" class="form-control" required='true' id="TaskPriority">
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
                              
                                $query = "SELECT * FROM `projects` WHERE `Status` = 0";
                                $query_run = mysqli_query($con, $query);
                                if (mysqli_num_rows($query_run) > 0) {
                                ?>
                                    <select type="text" name="pname" class="form-control" required='true' id="ProjectId">
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
                                <input type="text" name="tt" class="form-control" id="TaskTitle">
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Task Description</label>
                            <div class="col-sm-10">
                                <textarea type="text" name="td" class="form-control" id="TaskDescription"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Task End Date</label>
                            <div class="col-sm-10">
                                <input type="date" name="ted" class="form-control" id="TaskEnddate">
                            </div>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="TaskUpdate">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>



<div class="page-header">
    <h3 class="page-title">Task</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Task</a></li>
            <li class="breadcrumb-item active" aria-current="page">List Task</li>
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
                            <th> Task Title</th>
                            <th> Department Name</th>
                            <th> Task Description</th>
                            <th> Assign To</th>
                            <th> Assign Date</th>
                            <th> End of Date</th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                       
                        $query = "SELECT tasks.Id as tid, tasks.TaskTitle, tasks.DeptId, tasks.AssignTaskto, tasks.TaskEnddate, tasks.TaskAssigndate, departments.DepartmentName, departments.ID as did, employees.EmployeeName, employees.EmployeeUsername,tasks.TaskDescription FROM `tasks` JOIN departments ON departments.ID = tasks.DeptId JOIN employees ON employees.Id = tasks.AssignTaskto WHERE employees.EmployeeDept = $dept";
                        $result = mysqli_query($con, $query);
                        if (mysqli_num_rows($result) > 0) {
                            $number = 1;
                            while ($data = mysqli_fetch_array($result)) {
                        ?>
                                <tr>
                                    <td><?= $number ?></td>

                                    <td><?= $data['TaskTitle'] ?></td>
                                    <td><?= $data['DepartmentName'] ?></td>
                                    <td><?= $data['TaskDescription'] ?></td>
                                    <td><?= $data['EmployeeName'] ?> (<?= $data['EmployeeUsername'] ?>)</td>
                                    <td><?= $data['TaskAssigndate']  ?></td>
                                    <td><?= $data['TaskEnddate']  ?></td>
                                    <td><button type="button" class="btn btn-inverse-primary editbtn" data-id="<?= $data['tid'] ?>">Edit</button>
                                        <a type="button" class="btn btn-inverse-danger" href="<?php echo 'admin/demo.php?TDid=' . $data['tid']; ?>">Delete</a>
                                    </td>
                                </tr>
                                <?php $number++;  ?>
                        <?php

                            }
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>


<script>
    $(document).ready(function() {
        $(".editbtn").click(function() {
            $('#dept').modal('show');
            var id = $(this).data("id");
            $.ajax({
                type: "POST",
                url: "admin/ajaxdata.php",
                data: {
                    TaskId: id
                },
                dataType: "json",
                success: function(data) {
                    $('#TaskIt').val(data.tid);
                    $('#EmployeeName').val(data.Id);
                    $('#TaskPriority').val(data.TaskPriority);
                    $('#ProjectName').val(data.ProjectName);
                    $('#TaskTitle').val(data.TaskTitle);
                    $('#ProjectId').val(data.ProjectId);
                    $('#TaskDescription').val(data.TaskDescription);
                    $('#TaskEnddate').val(data.TaskEnddate);
                }
            });
        });
    });
</script>

<?php
include('Includes/footer.php');
?>