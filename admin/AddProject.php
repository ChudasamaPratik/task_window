<?php

include('../Includes/config.php');
if (!isset($_SESSION['IS_VALID']) && !isset($_SESSION['user'])) {
   header('location:../login.php');
    die();
}

include('Includes/sidebar.php');
include('Includes/navbar.php');
?>


<title>Project Add - .::Task Window::.</title>

<div class="page-header">
    <h3 class="page-title">Add Project</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Project</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Project</li>
        </ol>
    </nav>
</div>
<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <form class="form-sample" method="POST" action="demo.php">
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Project Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="pname" required />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary mr-2 p-2" name="AddProject">Submit</button>
                        <button type="reset" class="btn btn-dark p-2">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<?php
include('Includes/footer.php');
?>