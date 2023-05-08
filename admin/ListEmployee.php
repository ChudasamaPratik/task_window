<?php

include('../Includes/config.php');
if (!isset($_SESSION['IS_VALID']) && !isset($_SESSION['user'])) {
    header('location:../login.php');
    die();
}

include('Includes/sidebar.php');
include('Includes/navbar.php');


?>


<title>Employee List - .::Task Window::.</title>

<style>
    input[readonly] {
        background-color: #2a3038 !important;
    }
</style>

<div class="page-header">
    <h3 class="page-title">Employee</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Employee</a></li>
            <li class="breadcrumb-item active" aria-current="page">List Employee</li>
        </ol>
    </nav>
</div>




<!--EDIT Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Employee</h5>
                <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-sample" method="POST" action="demo.php" enctype='multipart/form-data'>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Employee Id</label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="EmployeeId" id="EmployeeId">
                                    <input type="text" class="form-control" name="eid" id="EmployeeUsername" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Employee Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="ename" id="EmployeeName" required />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Employee Email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" name="eemail" id="EmployeeEmail" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Date of Birth</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" placeholder="dd/mm/yyyy" id="EmployeeBirth" name="ebirth" required />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Department Name</label>
                                <div class="col-sm-9">
                                    <?php
                                    $query = "SELECT * FROM `departments`";
                                    $query_run = mysqli_query($con, $query);
                                    if (mysqli_num_rows($query_run) > 0) {

                                    ?>
                                        <select class=" form-control" name="edname" id="EmployeeDept">
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
                                <label class="col-sm-3 col-form-label">Gender</label>
                                <div class="col-sm-4">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="gender" id="EmployeeGender" value="Male" <?php  ?>> Male </label>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="gender" id="EmployeeGender" value="Female"> Female </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Employee Mobile</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="emobile" id="EmployeeMobile" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Empoyee Date of Joining</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" placeholder="dd/mm/yyyy" id="EmployeeJoin" name="ejoin" required />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Description(if any)</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="desc" id="EmployeeDesc" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Address</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="eadd" id="EmployeeAddress" required />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Role</label>
                                <div class="col-sm-9">
                                    <?php
                                    $query = "SELECT * FROM `role`";
                                    $query_run = mysqli_query($con, $query);
                                    if (mysqli_num_rows($query_run) > 0) {

                                    ?>
                                        <select class=" form-control" name="role" id="EmployeeRole">
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
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Employee Image</label>
                                <div class="col-sm-9">
                                    <input type="hidden" id="EmployeeImage" name="pimg_old">
                                    <input type="file" class="form-control" name="pimg" />
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary modal-close" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="UpdateEmployee">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>


<!--Show Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Show Employee</h5>
                <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered" style="color: #6c7293 !important;">
                    <tbody>
                        <tr>
                            <th> Employee Id</th>
                            <td id="showEmployeeUsername"></td>

                            <th>Employee Name</th>
                            <td id="showEmployeeName"></td>

                            <th class="text-center">Employee Image</th>

                        </tr>

                        <tr>
                            <th> Employee Email</th>
                            <td id="showEmployeeEmail"></td>

                            <th>Employee Date of Birth</th>
                            <td id="showEmployeeBirth"></td>
                            <td rowspan="4" class="text-center"><img id="showEmployeeImage" alt="Employee Image" style="height: 200px !important;width: 200px !important;" class="float-end"></td>
                        </tr>

                        <tr>
                            <th> Employee Department Name</th>
                            <td id="showEmployeeDept"></td>

                            <th>Employee Gender</th>
                            <td id="showEmployeeGender"></td>
                        </tr>

                        <tr>
                            <th> Employee Mobile</th>
                            <td id="showEmployeeMobile"> </td>

                            <th>Employee Joining Date</th>
                            <td id="showEmployeeJoin"></td>
                        </tr>

                        <tr>
                            <th> Description</th>
                            <td id="showEmployeeDesc"> </td>

                            <th>Address</th>
                            <td id="showEmployeeAddress"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary modal-close" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>





<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="8" class="text-center text-warning p-0 m-0"><h3>List Of HOD</h3></th>
                        </tr>
                        <tr>
                            <th> # </th>
                            <th> Department Name</th>
                            <th> Employee Name</th>
                            <th> Employee UserName</th>
                            <th> Employee Email </th>
                            <th> Employee Contact No. </th>
                            <th> Role </th>
                            <th class="text-center"> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM employees JOIN departments ON employees.EmployeeDept = departments.ID JOIN `role` ON employees.EmployeeRole = role.RoleId WHERE `flag` = 0 AND EmployeeRole = 2";
                        $result = mysqli_query($con, $query);
                        if (mysqli_num_rows($result) > 0) {
                            $number = 1;
                            while ($data = mysqli_fetch_array($result)) {
                        ?>
                                <tr>
                                    <td><?= $number ?></td>
                                    <td><?= strtoupper($data['DepartmentName']) ?></td>
                                    <td><?= ucwords($data['EmployeeName']) ?></td>
                                    <td><?= $data['EmployeeUsername'] ?></td>
                                    <td><?= $data['EmployeeEmail'] ?></td>
                                    <td><?= $data['EmployeeMobile'] ?></td>
                                    <td><?= $data['Name'] ?></td>
                                    <td class="text-center"><button type="button" class="btn btn-inverse-secondary showbtn" data-id="<?= $data['Id'] ?>">Show</button>
                                        <button type="button" class="btn btn-inverse-primary editbtn editbtn" data-id="<?= $data['Id'] ?>">Edit</button>
                                        <a type="button" class="btn btn-inverse-danger" href="<?php echo 'demo.php?EDid=' . $data['Id']; ?>">Delete</a>
                                    </td>
                                </tr>
                                <?php $number++;  ?>
                        <?php
                            }
                        }
                        else{
                            echo "<td class='text-center' colspan='8'>Data Not Found</td>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="8" class="text-center text-warning p-0 m-0"><h3>List Of Employees</h3></th>
                        </tr>
                        <tr>
                            <th> # </th>
                            <th> Department Name</th>
                            <th> Employee Name</th>
                            <th> Employee UserName</th>
                            <th> Employee Email </th>
                            <th> Employee Contact No. </th>
                            <th> Role </th>
                            <th class="text-center"> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM employees JOIN departments ON employees.EmployeeDept = departments.ID JOIN `role` ON employees.EmployeeRole = role.RoleId WHERE `flag` = 0 AND EmployeeRole = 3";
                        $result = mysqli_query($con, $query);
                        if (mysqli_num_rows($result) > 0) {
                            $number = 1;
                            while ($data = mysqli_fetch_array($result)) {
                        ?>
                                <tr>
                                    <td><?= $number ?></td>
                                    <td><?= strtoupper($data['DepartmentName']) ?></td>
                                    <td><?= $data['EmployeeName'] ?></td>
                                    <td><?= $data['EmployeeUsername'] ?></td>
                                    <td><?= $data['EmployeeEmail'] ?></td>
                                    <td><?= $data['EmployeeMobile'] ?></td>
                                    <td><?= $data['Name'] ?></td>
                                    <td class="text-center"><button type="button" class="btn btn-inverse-secondary showbtn" data-id="<?= $data['Id'] ?>">Show</button>
                                        <button type="button" class="btn btn-inverse-primary editbtn editbtn" data-id="<?= $data['Id'] ?>">Edit</button>
                                        <a type="button" class="btn btn-inverse-danger" href="<?php echo 'demo.php?EDid=' . $data['Id']; ?>">Delete</a>
                                    </td>
                                </tr>
                                <?php $number++;  ?>
                        <?php
                            }
                        }
                         else{
                            echo "<td class='text-center' colspan='8'>Data Not Found</td>";
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
    // Employee Data Edit
    $(document).ready(function() {

        $(".editbtn").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "POST",
                url: "ajaxdata.php",
                data: {
                    emid: id
                },
                dataType: "json",
                success: function(data) {
                    $('#EmployeeId').val(data.Id);
                    $('#EmployeeUsername').val(data.EmployeeUsername);
                    $('#EmployeeName').val(data.EmployeeName);
                    $('#EmployeeEmail').val(data.EmployeeEmail);
                    $('#EmployeeBirth').val(data.EmployeeBirth);
                    $('#EmployeeDept').val(data.EmployeeDept);
                    // $('#EmployeeGender').val(data.EmployeeGender);
                    $('#EmployeeMobile').val(data.EmployeeMobile);
                    $('#EmployeeJoin').val(data.EmployeeJoin);
                    $('#EmployeeDesc').val(data.EmployeeDesc);
                    $('#EmployeeMobile').val(data.EmployeeMobile);
                    $('#EmployeeRole').val(data.EmployeeRole);
                    $('#EmployeeAddress').val(data.EmployeeAddress);
                    $('#EmployeeImage').val(data.EmployeeImage);
                    $('input[type=radio][name="gender"][value='+data.EmployeeGender+']').prop('checked', true);
                }
            });
            $('#exampleModal').modal('show');
        });
        $(".modal-close").click(function() {
            $('#exampleModal').modal('hide');
        });




        //Employee Date Show
        $(".showbtn").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "POST",
                url: "ajaxdata.php",
                data: {
                    emid: id
                },
                dataType: "json",
                success: function(data) {
                    $('#showEmployeeUsername').text(data.EmployeeUsername);
                    $('#showEmployeeName').text(data.EmployeeName);
                    $('#showEmployeeEmail').text(data.EmployeeEmail);
                    $('#showEmployeeBirth').text(data.EmployeeBirth);
                    $('#showEmployeeDept').text(data.DepartmentName);
                    $('#showEmployeeGender').text(data.EmployeeGender);
                    $('#showEmployeeMobile').text(data.EmployeeMobile);
                    $('#showEmployeeJoin').text(data.EmployeeJoin);
                    $('#showEmployeeDesc').text(data.EmployeeDesc);
                    $('#showEmployeeImage').attr('src', 'Employee_image/' + data.EmployeeImage);
                    $('#showEmployeeAddress').text(data.EmployeeAddress);
                }
            });
            $('#exampleModal1').modal('show');
        });
        $(".modal-close").click(function() {
            $('#exampleModal1').modal('hide');
        });
    });
</script>


<?php
include('Includes/footer.php');
?>