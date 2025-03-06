<?php

session_start();

require_once("common_functions.php");

if(isset($_SESSION['admin_ssnlogin'])){
    $dest = "/admin/admin_login.php";
}
else{
    $dest = "index.php";
}

session_destroy();
header("Location: index.php");


