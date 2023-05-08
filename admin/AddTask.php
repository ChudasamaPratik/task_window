<?php

include('../Includes/config.php');
if (!isset($_SESSION['IS_VALID']) && !isset($_SESSION['user'])) {
    header('location:../login.php');
    die();
}

include('Includes/sidebar.php');
include('Includes/navbar.php');
?>

<script type="text/javascript">
function getemp(val) {
    $.ajax({
        type: "POST",
        url: "demo.php",
        data: 'edname=' + val,
        success: function(data) {
            $("#emplist").html(data);
        }
    });
}
</script>

<title>Task Assign - .::Task Window::.</title>
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
            <form class="form-sample" method="POST" action="demo.php">
                <div class="mt-3">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Department Name</label>
                        <div class="col-sm-10">
                            <?php
                            $query = "SELECT * FROM `departments`";
                            $query_run = mysqli_query($con, $query);
                            if (mysqli_num_rows($query_run) > 0) {

                            ?>
                            <select class=" form-control" type="text" name="dname" id="edname"
                                onChange="getemp(this.value);" value="" class="form-control" required='true'>
                                <option value="">Select Department</option>

                                <?php foreach ($query_run as $items) { ?>
                                <option value="<?= $items['ID'] ?>"><?= $items['DepartmentName'] ?></option>

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
                        <label class="col-sm-2 col-form-label">Employee Name</label>
                        <div class="col-sm-10">
                            <select type="text" name="emplist" id="emplist" value="" class="form-control"
                                required='true'>
                            </select>
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
                            <input type="text" name="tt" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Task Description</label>
                        <div class="col-sm-10">
                            <textarea type="text" name="td" class="form-control" required></textarea>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Task End Date</label>
                        <div class="col-sm-10">
                            <input type="date" name="ted" class="form-control" required>
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