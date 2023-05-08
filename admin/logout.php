<?php
session_start();
session_destroy();
echo "<script type='text/javascript'> document.location ='../login.php'; </script>";
// header('Location : login.php');