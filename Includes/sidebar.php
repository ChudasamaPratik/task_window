<!DOCTYPE html>
<html lang="en">


<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- plugins:css -->
<link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
<link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
<!-- endinject -->
<!-- Plugin css for this page -->
<link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
<link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
<link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
<link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">
<!-- End plugin css for this page -->
<!-- Layout styles -->
<link rel="stylesheet" href="assets/css/style.css">
<!-- End layout styles -->
<link rel="apple-touch-icon" sizes="180x180" href="assets/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="assets/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="assets/favicon-16x16.png">
<link rel="manifest" href="assets/site.webmanifest">
<style>
    body {
        font-family: 'Poppins', sans-serif !important;
    }
</style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->


        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
                <a class="sidebar-brand brand-logo" href="index.php" style="text-decoration: none;color: #d6d0d0;">
                    <h2>TASK WINDOW</h2>
                </a>
                <a class="sidebar-brand brand-logo-mini" href="#" style="text-decoration: none;color: #d6d0d0;">
                    <h2>TW</h2>
                </a>
            </div>
            <ul class="nav">
                <li class="nav-item nav-category">
                    <span class="nav-link">Navigation</span>
                </li>

                <!--Employee-->
                <?php
                if ($_SESSION['user']['EmployeeRole'] == 3) {
                ?>
                    <li class="nav-item menu-items">
                        <a class="nav-link" href="index.php">
                            <span class="menu-icon">
                                <i class="mdi mdi-speedometer"></i>
                            </span>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item menu-items">
                        <a class="nav-link" data-toggle="collapse" href="#task" aria-expanded="false" aria-controls="task">
                            <span class="menu-icon">
                                <i class="mdi mdi-laptop"></i>
                            </span>
                            <span class="menu-title">Task</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="task">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="NewTask.php">New Task</a></li>
                                <li class="nav-item"> <a class="nav-link" href="InprogressTask.php">Inprogress Task</a></li>
                                <li class="nav-item"> <a class="nav-link" href="CompletedTask.php">Completed Task</a></li>
                                <li class="nav-item"> <a class="nav-link" href="AllTask.php">All Task</a></li>
                            </ul>
                        </div>
                    </li>
                <?php } ?>



                <!--HOD -->
                <?php
                if ($_SESSION['user']['EmployeeRole'] == 2) {
                ?>
                    <li class="nav-item menu-items">
                        <a class="nav-link" href="index.php">
                            <span class="menu-icon">
                                <i class="mdi mdi-speedometer"></i>
                            </span>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item menu-items">
                        <a class="nav-link" data-toggle="collapse" href="#employee" aria-expanded="false" aria-controls="employee">
                            <span class="menu-icon">
                                <i class="mdi mdi-account-multiple-outline"></i>
                            </span>
                            <span class="menu-title">Employee</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="employee">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="ListEmployee.php">Manage Employee</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item menu-items">
                        <a class="nav-link" data-toggle="collapse" href="#task" aria-expanded="false" aria-controls="task">
                            <span class="menu-icon">
                                <i class="mdi mdi-laptop"></i>
                            </span>
                            <span class="menu-title">Task</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="task">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="AddTask.php">Add Task</a>
                                </li>
                                <li class="nav-item"> <a class="nav-link" href="ListTask.php">Manage Task</a></li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item menu-items">
                        <a class="nav-link" data-toggle="collapse" href="#ts" aria-expanded="false" aria-controls="ts">
                            <span class="menu-icon">
                                <i class="mdi mdi-laptop"></i>
                            </span>
                            <span class="menu-title">Task Status</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ts">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="TaskInprogress.php">Inprogress Task</a>
                                </li>
                                <li class="nav-item"> <a class="nav-link" href="TaskCompleted.php">Completed Task</a></li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item menu-items">
                        <a class="nav-link" href="TaskReport.php">
                            <span class="menu-icon">
                                <i class="mdi mdi-table-large"></i>
                            </span>
                            <span class="menu-title">Task Reports</span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </nav>

</html>