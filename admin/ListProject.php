<?php
include('../Includes/config.php');
if (!isset($_SESSION['IS_VALID']) && !isset($_SESSION['user'])) {
    header('location:../login.php');
    die();
}

include('Includes/sidebar.php');
include('Includes/navbar.php');


if (isset($_POST['UpdateProject'])) {

    $pid = $_POST['pid'];
    $ProjectName = ucwords($_POST['pname']);

    $sql = "UPDATE `projects` SET `ProjectName`='$ProjectName' WHERE `ID` = '$pid'";
    $result = $con->query($sql);
    if ($result == TRUE) {
        echo "<script type='text/javascript'> document.location ='ListProject.php'; </script>";
    } else {
        echo "Error";
    }
}
?>

<title>Project List - .::Task Window::.</title>
<div class="page-header">
    <h3 class="page-title">Project</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Project</a></li>
            <li class="breadcrumb-item active" aria-current="page">List Project</li>
        </ol>
    </nav>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Project</h5>
                <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-sample" method="POST">
                    <div class="mb-3">
                        <label for="dname" class="form-label">Project Name</label>
                        <input type="hidden" name="pid" id="id">
                        <input type="text" class="form-control" id="pname" name="pname" required>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary modal-close" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="UpdateProject">Save changes</button>
            </div>
            </form>
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
                            <th> Project Name</th>
                            <th> Create at</th>
                            <th> Status</th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM `projects`";
                        $result = mysqli_query($con, $query);
                        if (mysqli_num_rows($result) > 0) {
                            $number = 1;
                            while ($data = mysqli_fetch_array($result)) {
                        ?>
                                <tr>
                                    <td><?= $number ?></td>
                                    <td><?= ucwords($data['ProjectName']) ?></td>
                                    <td><?= date("d-m-Y h:i:s A", strtotime($data['Createat'])) ?></td>
                                    <td>
                                        <a class="<?php echo ($data['Status'] == 1) ? 'badge badge-success' : 'badge badge-warning'; ?>" href="<?php echo 'demo.php?pid=' . $data['ID']; ?>"><?php echo ($data['Status'] == 1) ? 'Completed' : 'In Progress'; ?></a>
                                    </td>
                                    <td><button type="button" class="btn btn-inverse-primary editbtn" data-pid="<?= $data['ID'] ?>">Edit</button> <a type="button" class="btn btn-inverse-danger" href="<?php echo 'demo.php?PDid=' . $data['ID']; ?>">Delete</a> </td>
                                </tr>
                                <?php $number++;  ?>
                            <?php

                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="4" class="text-center">Data Not Found</td>
                            </tr>
                        <?php
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
    $(document).ready(function() {
        $(".editbtn").click(function() {
            var pid = $(this).data("pid");
            $.ajax({
                type: "POST",
                url: "ajaxdata.php",
                data: {
                    pid: pid
                },
                dataType: "json",
                success: function(data) {
                    $('#pname').val(data.ProjectName);
                    $('#id').val(data.ID);
                }
            });
            $('#exampleModal').modal('show');
        });
        $(".modal-close").click(function() {
            $('#exampleModal').modal('hide');
        });
    });
</script>



<?php
include('Includes/footer.php');
?>