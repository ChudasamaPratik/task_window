
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Task Window - Password Set</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Password - .:: Task Window ::.</title>

    <link rel="stylesheet" type="text/css" href="assets/Login_css/util.css">
    <link rel="stylesheet" type="text/css" href="assets/Login_css/main.css">
    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-form-title" style="background-image: url(assets/images/auth/bg-01.jpg);" >
                    <span class="login100-form-title-1">
                        Task Window
                    </span>
            </div>

                <form method="POST" class="login100-form validate-form" autocomplete="off">
                    <div class="wrap-input100 validate-input m-b-26" data-validate="New Password is required">
                        <span class="label-input100">New Password</span>
                        <input class="input100" type="text" name="NewPassword" placeholder="Enter New Password">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-18" data-validate="Confirm Password is required">
                        <span class="label-input100">Confirm Password</span>
                        <input class="input100" type="password" name="ConfirmPassword" placeholder="Enter Confirm password">
                        <span class="focus-input100"></span>
                    </div>


                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn" name="login">
                            Set Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>