<?php

include('../Includes/config.php');
if (!isset($_SESSION['IS_VALID']) && !isset($_SESSION['user'])) {
    header('location:../login.php');
    die();
}

include('Includes/sidebar.php');
include('Includes/navbar.php');
?>
<title>All Task Report - .::Task Window::.</title>
<div class="page-header">
    <h3 class="page-title">Task Report</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Task Report</li>
        </ol>
    </nav>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Project</h5>
                <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-sample" method="POST">
                    <div class="mb-3">
                        <label for="dname" class="form-label">Project Name</label>
                        <input type="hidden" name="pid" id="id">
                        <input type="text" class="form-control" id="pname" name="pname" required>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary modal-close" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="UpdateProject">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <form method="POST">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="from">From Date</label>
                            <input type="date" name="from" id="from" class="form-control"  required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="to">To Date</label>
                            <input type="date" name="to" id="to" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mt-4 mb-0">
                            <button class="btn btn-success" type="submit" id="btn" name="filter">Filter Tasks</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <?php
    if (isset($_POST['filter'])) {
        $from = $_POST['from'];
        $to = $_POST['to'];
    ?>
        <h4 class="mt-5 text-center text-danger">Report from <span class="fst-italic"><?= date("d-m-Y", strtotime($from)) ?></span> To <span class="fst-italic text-decoration-underline"> <?= date("d-m-Y", strtotime($to)) ?></span></h4>
        <table class="table table-bordered mt-2" id="example">
            <thead>
                <tr>
                    <th> # </th>
                    <th> Task Title </th>
                    <th> Department Name </th>
                    <th> Project Name </th>
                    <th> Assign To </th>
                    <th> Assign Date </th>
                    <th> End Date </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT tasks.Id as tid, tasks.TaskTitle, tasks.DeptId, tasks.AssignTaskto, tasks.TaskEnddate, tasks.TaskAssigndate, departments.DepartmentName, departments.ID as did, employees.EmployeeName, employees.EmployeeUsername,projects.* FROM `tasks` JOIN `departments` ON departments.ID = tasks.DeptId JOIN `projects` ON projects.ID = tasks.ProjectId JOIN `employees` ON employees.Id = tasks.AssignTaskto WHERE tasks.TaskAssigndate BETWEEN '$from' AND '$to'";
                $data = $con->query($sql);

                if ($data->num_rows > 0) {
                    if (strtotime($from) < strtotime($to)) {
                        foreach ($data as $row) {
                ?>
                            <tr>
                                <td>1</td>
                                <td> <?= $row['TaskTitle'] ?> </td>
                                <td> <?= $row['DepartmentName'] ?> </td>
                                <td> <?= $row['ProjectName'] ?> </td>
                                <td> <?= $row['EmployeeName'] ?> </td>
                                <td><?= date("d-m-Y", strtotime($row['TaskAssigndate'])) ?></td>
                                <td><?= date("d-m-Y", strtotime($row['TaskEnddate'])) ?></td>
                            </tr>
            <?php
                        }
                    } else {
                        echo "No Record Found";
                    }
                } else {
                    echo "<script>alert('From Date is grater then To Date. Please Change...');</script>";
                }
            }
            ?>
            </tbody>
        </table>
</div>






<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>

<script>
    $(document).ready(function() {
        $(".editbtn").click(function() {
            var pid = $(this).data("pid");
            $.ajax({
                type: "POST",
                url: "ajaxdata.php",
                data: {
                },
                dataType: "json",
                success: function(data) {
                    console.log(data);
                }
            });
            $('#exampleModal').modal('show');
        });
        $(".modal-close").click(function() {
            $('#exampleModal').modal('hide');
        });
    });
</script>


<?php
include('Includes/footer.php');
?>