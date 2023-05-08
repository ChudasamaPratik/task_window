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

$id = $_SESSION['user']['Id'];

if (isset($_POST['change'])) {
    $old =md5($_POST['old']);
    $new =md5($_POST['new']);
    $confirm = md5($_POST['confirm']);

    $check = "SELECT * FROM `employees` WHERE `EmployeePassword` = '$old'";
    $check_result = mysqli_query($con, $check);
    if(mysqli_fetch_array($check_result) > 0) {
        if($new == $confirm)
        {   
            $update = "UPDATE `employees` SET `EmployeePassword`= '$new' WHERE `Id`= '$id'";
            $update_result = $con->query($update);
            echo "<script>alert('Password Change Successfully..');</script>";
        }
        else{
            echo "<script>alert('Password Does't Match... Try again Later!');</script>";
        }
    }
    else{
        echo "<script>alert('Old password Wrong...Data Not Found...');</script>";
    }
}
?>

<title>Change Password .::Task Window::.</title>

<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <form method="POST">
                <div class="form-group">
                    <label for="old">Current Password</label>
                    <input type="password" class="form-control" id="old" placeholder="Current Password" name="old" required>
                </div>
                <div class="form-group">
                    <label for="new">Password</label>
                    <input type="password" class="form-control" id="new" placeholder="New Password" name="new" required>
                </div>
                <div class="form-group">
                    <label for="ConfirmPassword1">Confirm Password</label>
                    <input type="password" class="form-control" id="ConfirmPassword1" placeholder="Confirm Password" name="confirm" required>
                </div>
                <button class="btn btn-outline-success" name="change" type="submit">Change</button>
            </form>
        </div>
    </div>
</div>





<?php
include('Includes/footer.php');
?>