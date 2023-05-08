<?php
include('Includes/config.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['Reset'])) {
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $newpassword = md5($_POST['newpassword']);

        $sql = "SELECT `EmployeeEmail` FROM `employees` WHERE EmployeeEmail = '$email' AND EmployeeMobile = '$mobile'";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            $sql = "UPDATE `employees` SET `EmployeePassword`='$newpassword' WHERE `EmployeeEmail` = '$email' AND `EmployeeMobile` = '$mobile'";
            $result = $con->query($sql);
            if ($result == TRUE) {
                echo "<script>alert('Your Password succesfully changed'); document.location = 'login.php';</script>";
            } else {
                echo "<script>alert('Email id or Mobile no is invalid');</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password - .:: Task Window ::.</title>
    <link rel="stylesheet" type="text/css" href="assets/Login_css/util.css">
    <link rel="stylesheet" type="text/css" href="assets/Login_css/main.css">

    <link rel="apple-touch-icon" sizes="180x180" href="assets/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon-16x16.png">
    <link rel="manifest" href="assets/site.webmanifest">

    <script type="text/javascript">
        function valid() {
            if (document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
                alert("New Password and Confirm Password Field do not match  !!");
                document.chngpwd.confirmpassword.focus();
                return false;
            }
            return true;
        }
    </script>
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-form-title" style="background-image: url(assets/images/auth/bg-01.jpg);">
                    <span class="login100-form-title-1">
                        TASK WINDOW
                    </span>
                </div>

                <form method="POST" class="login100-form validate-form" name="chngpwd" onSubmit="return valid();">
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Email is required">
                        <span class="label-input100">Email</span>
                        <input class="input100" type="email" name="email" placeholder="Enter Email" required="true">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-18" data-validate="Mobile Number is required">
                        <span class="label-input100">Mobile Number</span>
                        <input class="input100" type="number" name="mobile" maxlength="10" pattern="[0-9]+" placeholder="Enter Mobile Number" required="true">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="New Password is required">
                        <span class="label-input100">New Password</span>
                        <input class="input100" type="password" name="newpassword" placeholder="Enter New Password" required="true">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-18" data-validate="Confirm Password is required">
                        <span class="label-input100">Confirm Password</span>
                        <input class="input100" type="password" name="confirmpassword" placeholder="Enter Confirm Password" required="true">
                        <span class="focus-input100"></span>
                    </div>
                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn" name="Reset">
                            Reset
                        </button>
                    </div>
                    <p>Back to Login Page <a href="login.php">Login</a></p>
                </form>
            </div>
        </div>
    </div>
</body>

</html>