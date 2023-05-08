 <?php
    $role = $_SESSION['user']['EmployeeRole'];
    $id = $_SESSION['user']['Id'];
    include("config.php");

    $sql = "SELECT * FROM `tasks` WHERE `AssignTaskto` = '$id' AND `Status` = 'pending' ORDER BY TaskTitle  LIMIT 1";
    $data = mysqli_fetch_assoc(mysqli_query($con, $sql));

    ?>

 <div class="container-fluid page-body-wrapper">
     <nav class="navbar p-0 fixed-top d-flex flex-row">
         <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
             <a class="navbar-brand brand-logo-mini" href="#" style="text-decoration: none;color: #d6d0d0;">
                 <h2>TW</h2>
             </a>
         </div>
         <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
             <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                 <span class="mdi mdi-menu"></span>
             </button>
             <ul class="navbar-nav w-100">
                 <li class="nav-item w-100">
                     <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                         <input type="text" class="form-control" placeholder="Search products">
                     </form>
                 </li>
             </ul>
             <ul class="navbar-nav navbar-nav-right">
                 <?php if ($role == 3) { ?>
                     <li class="nav-item dropdown">
                         <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                             <i class="mdi mdi-bell"></i>
                             <?php
                                 echo @($data['Status'] == "pending") ? "<span class='count bg-danger'></span>" : "";
                                ?>
                         </a>
                         <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                             <h6 class="p-3 mb-0">Notifications</h6>
                             <div class="dropdown-divider"></div>
                             <a class="dropdown-item preview-item">
                                 <div class="preview-thumbnail">
                                     <div class="preview-icon bg-dark rounded-circle">
                                         <i class="mdi mdi-calendar text-success"></i>
                                     </div>
                                 </div>

                                 <div class="preview-item-content">
                                     <p class="preview-subject mb-1"><?php echo @($data['Status'] == "pending") ? $data['TaskTitle'] . "<span class='text-danger'>(" . date("d/m/Y", strtotime($data['TaskEnddate'])) . ")</span>" : "Pending Task Not Found"; ?>
                                     </p>
                                     <p class="text-muted ellipsis mb-0 pb-1"><?php echo @($data['Status'] == "pending") ? $data['TaskDescription'] : ""; ?></p>
                                 </div>
                             </a>
                             <div class="dropdown-divider"></div>
                         </div>
                     </li>
                 <?php } ?>
                 <li class="nav-item dropdown">
                     <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                         <div class="navbar-profile">
                             <i class="mdi mdi-account" style="font-size: x-large;"></i>
                             <p class="mb-0 d-none d-sm-block navbar-profile-name">
                                 <?= ucfirst($_SESSION['user']['EmployeeEmail']) ?></p>
                             <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                         </div>
                     </a>
                     <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                         <a class="dropdown-item preview-item" href="Profile.php">
                             <div class="preview-thumbnail">
                                 <div class="preview-icon bg-dark rounded-circle">
                                     <i class="mdi mdi-account"></i>
                                 </div>
                             </div>
                             <div class="preview-item-content">
                                 <p class="preview-subject mb-1">Profile</p>
                             </div>
                         </a>
                         <div class="dropdown-divider"></div>
                         <a class="dropdown-item preview-item" href="ChangePassword.php">
                             <div class="preview-thumbnail">
                                 <div class="preview-icon bg-dark rounded-circle">
                                     <i class="mdi mdi-onepassword text-info"></i>
                                 </div>
                             </div>
                             <div class="preview-item-content">
                                 <p class="preview-subject mb-1"> Change Password
                                 </p>
                             </div>
                         </a>
                         <div class="dropdown-divider"></div>
                         <a class="dropdown-item preview-item" href="logout.php">
                             <div class="preview-thumbnail">
                                 <div class="preview-icon bg-dark rounded-circle">
                                     <i class="mdi mdi-logout text-danger"></i>
                                 </div>
                             </div>
                             <div class="preview-item-content">
                                 <p class="preview-subject mb-1"> Log out
                                 </p>
                             </div>
                         </a>
                     </div>
                 </li>
             </ul>
             <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                 <span class="mdi mdi-format-line-spacing"></span>
             </button>
         </div>
     </nav>
     <div class="main-panel">
         <div class="content-wrapper">