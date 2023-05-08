<?php

    include('Includes/config.php');
    if (!isset($_SESSION['IS_VALID']) && !isset($_SESSION['user'])) {
        header('location:logout.php');
        die();
    }

    include('Includes/sidebar.php');
    include('Includes/navbar.php');

    if (isset($_POST['proupdate'])) {
        $id = $_SESSION['user']['Id'];
        $Name = $_POST['EmployeeName'];
        $Email = $_POST['EmployeeEmail'];
        $Address = $_POST['Address'];

        $old_image = $_POST['pimg_old'];
        
        $allowed_extensions = array(".jpg", "jpeg", ".png", ".PNG");

        if (!empty($_FILES['pimg']['name'])) {

            $extension = substr($_FILES['pimg']['name'], strlen($_FILES['pimg']['name']) - 4, strlen($_FILES['pimg']['name']));

            if (!in_array($extension, $allowed_extensions)) {
                echo "<script>alert('Pic has Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
            } else {
                
                $pic = time() . $extension;
                move_uploaded_file($_FILES["pimg"]["tmp_name"], 'admin/Employee_image/' . $pic);

                $sql = "UPDATE employees SET EmployeeImage='$pic' WHERE id=$id";
                mysqli_query($con, $sql);

                $old_image_path = "admin/Employee_image/" . $old_image;
                if (file_exists($old_image_path)) {
                    unlink($old_image_path);
                }
            }
        }


        $sql = "UPDATE `employees` SET `EmployeeName`='$Name',`EmployeeEmail`='$Email',`EmployeeAddress`='$Address' WHERE `Id`='$id'";
        $result = $con->query($sql);
        if ($result == TRUE) {
            echo "<script>document.location ='Profile.php';</script>";
        } else {
            echo "<script>alert('Invalid data');</script>";
        }
    }

    ?>

<title>Profile - .:: Task Window ::.</title>

    <style>
        input[readonly] {
            background-color: #2a3038 !important;
        }
    </style>

    <div class="row">
        <div class="col-lg-3 grid-margin">
            <img id="showEmployeeImage" alt="Profile Image" height="200" width="200" class="rounded mx-auto d-block">
        </div>
        <div class="col-lg-8 grid-margin stretch-card">
            <div class="card-body">
                <form class="form-sample" method="POST" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="showEmployeeUsername" class="col-sm-3 col-form-label">Employee Id</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="showEmployeeUsername" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="showEmployeeName" class="col-sm-3 col-form-label">Employee Name <span class="text-danger">*</span> </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="showEmployeeName" name="EmployeeName" style="background-color:  #7e848ceb !important;">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="showEmployeeEmail" class="col-sm-3 col-form-label">Employee Email <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="showEmployeeEmail" name="EmployeeEmail" style="background-color:  #7e848ceb !important;">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="showEmployeeBirth" class="col-sm-3 col-form-label">Date of Birth</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="showEmployeeBirth" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="showEmployeeDept" class="col-sm-3 col-form-label">Department Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="showEmployeeDept" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="showEmployeeMobile" class="col-sm-3 col-form-label">Employee Mobile</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="showEmployeeMobile" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="showEmployeeJoin" class="col-sm-3 col-form-label">Empoyee Date of Joining</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="showEmployeeJoin" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="showEmployeeDesc" class="col-sm-3 col-form-label">Description(if any)</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="showEmployeeDesc" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="showEmployeeAddress" class="col-sm-3 col-form-label">Address <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="showEmployeeAddress" name="Address" style="background-color:  #7e848ceb !important;">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pic" class="col-sm-3 col-form-label">Employee Image <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="hidden" class="form-control" id="showEmployeeImageUpdate" name="pimg_old" >
                            <input type="file" class="form-control" name="pimg" style="background-color:  #7e848ceb !important;">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-outline-success" name="proupdate">Update</button>
                </form>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>

    <script>
        var id = ("<?= $_SESSION['user']['Id'] ?>");
        $(document).ready(function() {
            $.ajax({
                type: "POST",
                url: "admin/ajaxdata.php",
                data: {
                    emid: id
                },
                dataType: "json",
                success: function(data) {
                    $('#showEmployeeUsername').val(data.EmployeeUsername);
                    $('#showEmployeeName').val(data.EmployeeName);
                    $('#showEmployeeEmail').val(data.EmployeeEmail);
                    $('#showEmployeeBirth').val(data.EmployeeBirth);
                    $('#showEmployeeDept').val(data.DepartmentName);
                    $('#showEmployeeMobile').val(data.EmployeeMobile);
                    $('#showEmployeeJoin').val(data.EmployeeJoin);
                    $('#showEmployeeDesc').val(data.EmployeeDesc);
                    $('#showEmployeeImage').attr('src', 'admin/Employee_image/' + data
                        .EmployeeImage)
                    $('#showEmployeeImageUpdate').attr('value', data.EmployeeImage);
                    $('#showEmployeeAddress').val(data.EmployeeAddress);
                    $('#showEmployeeRole').val(data.EmployeeRole);
                }
            });
        });
    </script>


    <?php
    include('Includes/footer.php');
    ?>