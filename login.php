<?php
include('Includes/config.php');
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT Id,EmployeeEmail,EmployeeRole FROM `employees` WHERE  `EmployeeEmail` = '$username'  && `EmployeePassword` = '$password' ";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();
    if ($result->num_rows > 0) {
        $_SESSION['user'] = $row;
        if ($_SESSION['user']['EmployeeRole'] == 1) {
            echo "<script type='text/javascript'> document.location ='admin/index.php'; </script>";
        } else {
            echo "<script type='text/javascript'> document.location ='index.php'; </script>";
        }
    } else {
        echo "<script>alert('Invalid Email and Password..');</script>";
    }
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - .:: Task Window ::.</title>
    <link rel="stylesheet" type="text/css" href="assets/Login_css/util.css">
    <link rel="stylesheet" type="text/css" href="assets/Login_css/main.css">

    <link rel="apple-touch-icon" sizes="180x180" href="assets/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon-16x16.png">
    <link rel="manifest" href="assets/site.webmanifest">
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

                <form method="POST" class="login100-form validate-form">
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100">Username</span>
                        <input class="input100" type="text" name="username" placeholder="Enter username">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-18" data-validate="Password is required">
                        <span class="label-input100">Password</span>
                        <input class="input100" type="password" name="password" placeholder="Enter password">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="flex-sb-m w-full p-b-30">
                        <div class="contact100-form-checkbox">
                            <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                            <label class="label-checkbox100" for="ckb1">
                                Remember me
                            </label>
                        </div>

                        <div>
                            <a href="ForgotPassword.php" class="txt1">
                                Forgot Password?
                            </a>
                        </div>
                    </div>

                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn" name="login">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>