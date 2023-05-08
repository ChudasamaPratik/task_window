<?php
include('../Includes/config.php');


if (isset($_POST['AddProject'])) {
    $pname = ucwords($_POST['pname']);

    $dublicatea = "SELECT * FROM `projects` WHERE `ProjectName` = '$pname'";
    $result = mysqli_query($con, $dublicatea);
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Data already exist'); document.location ='AddProject.php';</script>";
    } else {
        $sql = "INSERT INTO `projects`(`ProjectName`) VALUES ('$pname')";
        $result1 = mysqli_query($con, $sql);
        if ($result1) {
            echo "<script type='text/javascript'> alert('Add Project'); document.location ='ListProject.php'; </script>";
        } else {
            echo "<script>alert('Invalid data');</script>";
        }
    }
}


if (isset($_GET['PDid'])) {
    $PDid = $_GET['PDid'];

    $sql = "DELETE FROM `projects` WHERE `ID` = '$PDid'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        echo "<script type='text/javascript'> document.location ='ListProject.php'; </script>";
    } else {
        echo "<script>alert('Error in Project');</script>";
    }
}


if (isset($_POST['AddEmployee'])) {
    $EmployeeUsername = $_POST['eid'];
    $EmployeeName = ucwords($_POST['ename']);
    $EmployeeEmail = $_POST['eemail'];
    $EmployeeBirth = $_POST['ebirth'];
    $EmployeeDept = $_POST['dname'];
    $EmployeeGender = $_POST['gender'];
    $EmployeeMobile = $_POST['emobile'];
    $EmployeeJoin = $_POST['ejoin'];
    $EmployeeDesc = $_POST['desc'];
    $EmployeePassword = md5($_POST['epass']);
    $EmployeeAddress = $_POST['eadd'];
    $EmployeeRole = $_POST['role'];

    $pic = $_FILES["pic"]["name"];
    $extension = substr($pic, strlen($pic) - 4, strlen($pic));
    $allowed_extensions = array(".jpg", "jpeg", ".png", ".PNG");


    $dublicatea = "SELECT * FROM `employees` WHERE `EmployeeUsername` = '$EmployeeUsername' AND `EmployeeEmail` = '$EmployeeEmail' AND `EmployeeMobile` = '$EmployeeMobile'";
    $result = mysqli_query($con, $dublicatea);
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Data already exist');</script>";
    } else {

        if (!in_array($extension, $allowed_extensions)) {
            echo "<script>alert('Pic has Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
        } else {
            $pic = time() . $extension;
            move_uploaded_file($_FILES["pic"]["tmp_name"], 'Employee_image/' . $pic);

            $sql = "INSERT INTO `employees`(`EmployeeUsername`, `EmployeeName`, `EmployeeEmail`, `EmployeeBirth`, `EmployeeDept`, `EmployeeGender`, `EmployeeMobile`, `EmployeeJoin`, `EmployeeDesc`, `EmployeePassword`, `EmployeeAddress`, `EmployeeRole`, `EmployeeImage`) VALUES ('$EmployeeUsername','$EmployeeName','$EmployeeEmail','$EmployeeBirth','$EmployeeDept','$EmployeeGender','$EmployeeMobile','$EmployeeJoin','$EmployeeDesc','$EmployeePassword','$EmployeeAddress','$EmployeeRole','$pic')";
            $result1 = $con->query($sql);
            $NewHOD = $con->insert_id;

            if ($result1 == TRUE) {

                if ($EmployeeRole == 2) {
                    $q = "SELECT HOD_id from `departments` WHERE `ID`= $EmployeeDept";
                    $EmployeeId = mysqli_fetch_assoc($con->query($q));
                    $ejid =  $EmployeeId['HOD_id'];

                    $sql = "UPDATE `employees` SET `EmployeeRole`= 3 WHERE `Id` = $ejid";
                    $con->query($sql);

                    $sql = "UPDATE `departments` SET `HOD_id`= $NewHOD WHERE `ID`= $EmployeeDept";

                    $con->query($sql);
                }

                echo "<script type='text/javascript'>document.location ='ListEmployee.php'; alert('Employee Add Successfully...!');</script>";
            } else {
                echo "<script>alert('Invalid data'); document.location ='AddEmployee.php';</script>";
            }
        }
    }
}


if (isset($_POST['AddDepartment'])) {
    $dname = ucwords($_POST['dname']);

    $dublicatea = "SELECT * FROM `departments` WHERE `DepartmentName` = '$dname'";
    $result = mysqli_query($con, $dublicatea);
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Data already exist');</script>";
    } else {
        $sql = "INSERT INTO `departments`(`DepartmentName`) VALUES ('$dname')";
        $result1 = mysqli_query($con, $sql);
        if ($result1) {
            echo "<script type='text/javascript'> alert('Add Department'); document.location ='ListDepartment.php'; </script>";
        } else {
            echo "<script>alert('Invalid data');</script>";
        }
    }
}

if (isset($_GET['Did'])) {
    $Did = $_GET['Did'];

    $sql = "DELETE FROM `departments` WHERE `ID` = '$Did'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        echo "<script type='text/javascript'> document.location ='ListDepartment.php'; </script>";
    } else {
        echo "<script>alert('Error in Department');</script>";
    }
}






if (!empty($_POST["edname"])) {
    $deptid = $_POST["edname"];
    $sql = "SELECT * FROM `employees` WHERE `EmployeeDept` = $deptid AND `EmployeeRole` = 3 AND `flag` = 0";
    $result = $con->query($sql);
    if(mysqli_num_rows($result) > 0 ){
?>
    <option value="">Slect Employee</option>
    <?php
    while ($row = $result->fetch_assoc()) {
    ?>
        <option value="<?php echo $row["Id"]; ?>"><?php echo $row["EmployeeName"]; ?></option>
<?php
    }
}else{
    echo "<option>Employee Not Found</option>";
}
    }













if (isset($_POST['AddTask'])) {
    $Deptid = $_POST['dname'];
    $Empid = $_POST['emplist'];
    $Priority = $_POST['tp'];
    $Projid = $_POST['pname'];
    $Title = $_POST['tt'];
    $Desc = $_POST['td'];
    $Enddate = $_POST['ted'];


    $sql = "INSERT INTO `tasks`(`DeptId`, `AssignTaskto`, `TaskPriority`, `ProjectId`, `TaskTitle`, `TaskDescription`, `TaskEnddate`) VALUES ('$Deptid','$Empid','$Priority','$Projid','$Title','$Desc','$Enddate')";
    $result1 = mysqli_query($con, $sql);
    if ($result1 == TRUE) {
        echo "<script type='text/javascript'> alert('Add Task'); document.location ='ListTask.php'; </script>";
    } else {
        echo "<script>alert('Invalid data');</script>";
    }
}


if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
    $result = $con->query("SELECT * FROM `projects` WHERE `ID` = $pid")->fetch_assoc();
    $result = $result['Status'];
    if($result == 1)
    {
        $query = "UPDATE `projects` SET `Status`= 0 WHERE `ID` = $pid";
    }
    if($result == 0)
    {
        $query = "UPDATE `projects` SET `Status`= 1 WHERE `ID` = $pid";
    }
    $result = mysqli_query($con, $query);
    if ($result == TRUE) {
        echo "<script type='text/javascript'>document.location ='ListProject.php'; </script>";
    } else {
        echo "<script>alert('Error in Project Status Updatetion.');</script>";
    }
}


if (isset($_GET['TDid'])) {
    $id = $_GET['TDid'];

    $query = "DELETE FROM `tasks` WHERE `Id` = $id";
    $result = mysqli_query($con, $query);
    if ($result = TRUE) {
        echo "<script type='text/javascript'> alert('Task Deleted..');  </script>";
    } else {
        echo "<script>alert('Error in Task Delete Admin.');</script>";
    }
}



if (isset($_GET['EDid'])) {
    $id = $_GET['EDid'];
    $sql = "UPDATE `employees` SET `flag`= 1 WHERE `Id`=$id";
    $result = mysqli_query($con, $sql);
    if ($result == TRUE) {
        echo "<script type='text/javascript'> alert('Employee Deleted..'); document.location ='ListEmployee.php'; </script>";
    } else {
        echo "<script>alert('Error in Employee Delete Admin.');</script>";
    }
}






if (isset($_POST['UpdateEmployee'])) {
    $id = $_POST['EmployeeId'];
    $EmployeeName = $_POST['ename'];
    $EmployeeEmail = $_POST['eemail'];
    $EmployeeBirth = $_POST['ebirth'];
    $EmployeeDept = $_POST['edname'];
    $EmployeeGender = $_POST['gender'];
    $EmployeeMobile = $_POST['emobile'];
    $EmployeeJoin = $_POST['ejoin'];
    $EmployeeDesc = $_POST['desc'];
    $EmployeeAddress = $_POST['eadd'];
    $EmployeeRole = $_POST['role'];

    $old_image = $_POST['pimg_old'];

    $allowed_extensions = array(".jpg", "jpeg", ".png", ".PNG");

    if (!empty($_FILES['pimg']['name'])) {

        $extension = substr($_FILES['pimg']['name'], strlen($_FILES['pimg']['name']) - 4, strlen($_FILES['pimg']['name']));

        if (!in_array($extension, $allowed_extensions)) {
            echo "<script>alert('Pic has Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
        } else {

            $pic = time() . $extension;
            move_uploaded_file($_FILES["pimg"]["tmp_name"], 'Employee_image/' . $pic);

            $sql = "UPDATE employees SET EmployeeImage='$pic' WHERE id=$id";
            mysqli_query($con, $sql);

            $old_image_path = "Employee_image/" . $old_image;
            if (file_exists($old_image_path)) {
                unlink($old_image_path);
            }
        }
    }


    $sql = "UPDATE `employees` SET `EmployeeName` = '$EmployeeName', `EmployeeEmail` = '$EmployeeEmail', `EmployeeBirth` = '$EmployeeBirth', `EmployeeDept` = '$EmployeeDept', `EmployeeGender` = '$EmployeeGender', `EmployeeMobile` = '$EmployeeMobile', `EmployeeJoin` = '$EmployeeJoin', `EmployeeDesc` = '$EmployeeDesc', `EmployeeAddress` = '$EmployeeAddress', `EmployeeRole` = '$EmployeeRole'  WHERE `Id`='$id'";
    $result = $con->query($sql);

    if ($result == TRUE) {
        if ($EmployeeRole == 3) {

            $q = "SELECT HOD_id from `departments` WHERE `ID`= $EmployeeDept";
            $EmployeeId = mysqli_fetch_assoc($con->query($q));
            $ejid =  $EmployeeId['HOD_id'];

            $sql = "UPDATE `departments` SET `HOD_id`= NULL WHERE `ID`= $EmployeeDept";

            $con->query($sql);
        }
        if ($EmployeeRole == 2) {
            $q = "SELECT HOD_id from `departments` WHERE `ID`= $EmployeeDept";
            $EmployeeId = mysqli_fetch_assoc($con->query($q));
            $ejid =  $EmployeeId['HOD_id'];

            $sql = "UPDATE `departments` SET `HOD_id`= $id WHERE `ID`= $EmployeeDept";

            $con->query($sql);
        }
        echo "<script>document.location ='ListEmployee.php';</script>";
    } else {
        echo "<script>alert('Invalid data');</script>";
    }
}
?>