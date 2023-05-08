<?php

include('Includes/config.php');
if (!isset($_SESSION['IS_VALID']) && !isset($_SESSION['user'])) {
    header('location:login.php');
    die();
}

include('Includes/sidebar.php');
include('Includes/navbar.php');
?>

<title>Employee List - .:: Task Window ::.</title>

<div class="page-header">
    <h3 class="page-title">Employee</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Employee</a></li>
            <li class="breadcrumb-item active" aria-current="page">List Employee</li>
        </ol>
    </nav>
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
                            <th> # </th>
                            <th> Department Name</th>
                            <th> Employee Name</th>
                            <th> Employee UserName</th>
                            <th> Employee Email </th>
                            <th> Employee Contact No. </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $user_id = $_SESSION['user']['Id'];
                        $query = "SELECT * FROM employees JOIN departments ON employees.EmployeeDept = departments.ID WHERE departments.HOD_id = '$user_id' AND employees.EmployeeRole = 3 AND employees.flag = 0";
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
                                    <td><button type="button" class="btn btn-inverse-secondary showbtn" data-id="<?= $data['Id'] ?>">Show</button>
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
    // Employee Data Edit
    $(document).ready(function() {
        //Employee Date Show
        $(".showbtn").click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "POST",
                url: "admin/ajaxdata.php",
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
                    $('#showEmployeeImage').attr('src', 'admin/Employee_image/' + data
                        .EmployeeImage);
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