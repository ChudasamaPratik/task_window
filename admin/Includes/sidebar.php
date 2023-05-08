<!DOCTYPE html>
<html lang="en">


<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- <title>Corona Admin</title> -->

<!-- plugins:css -->
<link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
<link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
<!-- endinject -->
<!-- Plugin css for this page -->
<link rel="stylesheet" href="../assets/vendors/jvectormap/jquery-jvectormap.css">
<link rel="stylesheet" href="../assets/vendors/flag-icon-css/css/flag-icon.min.css">
<link rel="stylesheet" href="../assets/vendors/owl-carousel-2/owl.carousel.min.css">
<link rel="stylesheet" href="../assets/vendors/owl-carousel-2/owl.theme.default.min.css">
<!-- End plugin css for this page -->
<!-- inject:css -->
<!-- endinject -->
<!-- Layout styles -->
<link rel="stylesheet" href="../assets/css/style.css">
<!-- End layout styles -->

<link rel="apple-touch-icon" sizes="180x180" href="../assets/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../assets/favicon-16x16.png">
<link rel="manifest" href="../assets/site.webmanifest">
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->


        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
                <a class="sidebar-brand brand-logo" href="index.php" style="text-decoration: none;color: #d6d0d0;">
                <h2>TASK WINDOW</h2>
                </a>
                <a class="sidebar-brand brand-logo-mini" href="#" style="text-decoration: none;color: #d6d0d0;"><h2>TW</h2></a>
            </div>
            <ul class="nav">
                <li class="nav-item profile">
                    <div class="profile-desc">
                        <div class="profile-pic">
                            <div class="count-indicator">
                                <i class="mdi mdi-account" style="font-size: x-large;"></i>
                            </div>
                            <div class="profile-name">
                                <h5 class="mb-0 font-weight-normal"><?= ucfirst($_SESSION['user']['EmployeeEmail']) ?>
                                </h5>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item nav-category">
                    <span class="nav-link">Navigation</span>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="index.php">
                        <span class="menu-icon">
                            <i class="mdi mdi-speedometer"></i>
                        </span>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item menu-items">
                    <a class="nav-link" data-toggle="collapse" href="#pro" aria-expanded="false" aria-controls="pro">
                        <span class="menu-icon">
                            <i class="mdi mdi-laptop"></i>
                        </span>
                        <span class="menu-title">Projects</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="pro">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="AddProject.php">Add</a>
                            </li>
                            <li class="nav-item"> <a class="nav-link" href="ListProject.php">Manage</a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item menu-items">
                    <a class="nav-link" data-toggle="collapse" href="#dept" aria-expanded="false" aria-controls="dept">
                        <span class="menu-icon">
                            <i class="mdi mdi-laptop"></i>
                        </span>
                        <span class="menu-title">Department</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="dept">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="AddDepartment.php">Add</a>
                            </li>
                            <li class="nav-item"> <a class="nav-link" href="ListDepartment.php">Manage</a></li>
                        </ul>
                    </div>
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
                            <li class="nav-item"> <a class="nav-link" href="AddEmployee.php">Add Employee</a>
                            </li>
                            <li class="nav-item"> <a class="nav-link" href="ListEmployee.php">Manage Employee</a></li>
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
            </ul>
        </nav>