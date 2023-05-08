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
    function checkempidAvailability() {
        $("#loaderIcon").show();
        jQuery.ajax({
            url: "ajaxdata.php",
            data: 'empid=' + $("#empid").val(),
            type: "POST",
            success: function(data) {
                $("#empid-status").html(data);
                $("#loaderIcon").hide();
            },
            error: function() {}
        });
    }
</script>

<title>Employee Add - .::Task Window::.</title>
<div class="page-header">
    <h3 class="page-title">Add Employee</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Employee</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Employee</li>
        </ol>
    </nav>
</div>
<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <form class="form-sample" method="POST" action="demo.php" enctype='multipart/form-data'>
                <p class="card-description"> Personal info </p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Employee Id<span class="text-danger"> *</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="eid" id="empid" required onBlur="checkempidAvailability()" />
                                <span id="empid-status"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Employee Name<span class="text-danger"> *</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="ename" required />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Employee Email<span class="text-danger"> *</span></label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="eemail" required />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Date of Birth<span class="text-danger"> *</span></label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" placeholder="dd/mm/yyyy" name="ebirth" required />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Department Name<span class="text-danger"> *</span></label>
                            <div class="col-sm-9">
                                <?php
                                $query = "SELECT * FROM `departments`";
                                $query_run = mysqli_query($con, $query);
                                if (mysqli_num_rows($query_run) > 0) {

                                ?>
                                    <select class=" form-control" name="dname" required>
                                        <option disabled selected>Select Department</option>
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
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Gender<span class="text-danger"> *</span></label>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="gender" id="membershipRadios1" value="Male" checked> Male </label>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="gender" id="membershipRadios2" value="Female"> Female </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Employee Mobile<span class="text-danger"> *</span></label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="emobile" maxlength="10" min="10"  pattern="[0-9]+" required />
                              
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Date of Joining<span class="text-danger"> *</span></label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" placeholder="dd/mm/yyyy" name="ejoin" required />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Description(if any)</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="desc"  />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Password<span class="text-danger"> *</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="epass" required />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Address<span class="text-danger"> *</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="eadd" required />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Role<span class="text-danger"> *</span></label>
                            <div class="col-sm-9">
                                <?php
                                $query = "SELECT * FROM `role`";
                                $query_run = mysqli_query($con, $query);
                                if (mysqli_num_rows($query_run) > 0) {

                                ?>
                                    <select class=" form-control" name="role" required>
                                        <?php foreach ($query_run as $items) { ?>
                                            <option value="<?= $items['RoleId'] ?>"><?= $items['Name'] ?></option>

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
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Employee Image<span class="text-danger"> *</span></label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="pic" required />
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary mr-2" name="AddEmployee">Submit</button>
                    <button class="btn btn-dark">Cancel</button>
                </div>
            </form>
        </div>
    </div>

</div>
 

<?php
include('Includes/footer.php');
?>