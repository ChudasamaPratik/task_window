<?php

include('../Includes/config.php');
if (!isset($_SESSION['IS_VALID']) && !isset($_SESSION['user'])) {
    header('location:../login.php');
    die();
}

include('Includes/sidebar.php');
include('Includes/navbar.php');

if (isset($_POST['UpdateDepartment'])) {
    $did = $_POST['uid'];
    $dname = $_POST['dname'];

    $sql = "UPDATE `departments` SET `DepartmentName`= '$dname' WHERE `ID` = '$did'";
    $result = $con->query($sql);
    if ($result == TRUE) {
        echo "<script type='text/javascript'> document.location ='ListDepartment.php'; </script>";
    } else {
        echo "Error";
    }
}
?>
<title>Department List - .::Task Window::.</title>

<div class="page-header">
    <h3 class="page-title">Department</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Department</a></li>
            <li class="breadcrumb-item active" aria-current="page">List Department</li>
        </ol>
    </nav>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Department</h5>
                <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-sample" method="POST">
                    <div class="mb-3">
                        <label for="dname" class="form-label">Department Name</label>
                        <input type="hidden" name="uid" id="id">
                        <input type="text" class="form-control" name="dname" id="dname" required>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary modal-close" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="UpdateDepartment">Save changes</button>
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
                            <th> Department Name</th>
                            <th> Create at</th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM `departments`";
                        $result = mysqli_query($con, $query);
                        if (mysqli_num_rows($result) > 0) {
                            $number = 1;
                            while ($data = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td><?= $number ?></td>
                            <td><?= strtoupper($data['DepartmentName']) ?></td>
                            <td><?= $data['CreateAt'] ?></td>
                            <td><button type="button" class="btn btn-inverse-primary editbtn"
                                    data-id="<?= $data['ID'] ?>">Edit</button> <a type="button"
                                    class="btn btn-inverse-danger"
                                    href="<?php echo 'demo.php?Did=' . $data['ID']; ?>">Delete</a> </td>
                        </tr>
                        <?php $number++;  ?>
                        <?php

                            }
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script>
$(document).ready(function() {
    $(".editbtn").click(function() {
        var id = $(this).data("id");
        $.ajax({
            type: "POST",
            url: "ajaxdata.php",
            data: {
                eid: id
            },
            dataType: "json",
            success: function(data) {
                console.log(data);
                $('#dname').val(data.DepartmentName);
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