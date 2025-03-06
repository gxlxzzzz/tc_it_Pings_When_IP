<?php

session_start();  // connects to the session to pull through the session variables

require_once 'admin_functions.php';
require_once '../dbconnect/db_connect_master.php';
require_once '../common_functions.php';

if (!isset($_SESSION['admin_ssnlogin']) || $_SESSION['priv']=='EDITOR'){  // checks for logged in OR if they are only an editor
    $_SESSION['ERROR'] = "Admin not logged in / not enough privileges.";  //sets error message
    header("Location: admin_login.php");  // redirects them to another place
    exit; // Stop further execution
}

elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {  // if to ensure POST AND appropriate admin level
    try {  //try this code
        $longtask = $_SESSION['username'] . " added new user type of " . $_POST['type'];
        if (add_usertype(dbconnect_insert(), $_POST) && auditor(dbconnect_insert(), $_SESSION['username'], "USERADD", $longtask)) {
            $_SESSION['SUCCESS'] = $_POST['type']. " user type registered successfully.";
            header("Location: add_usertype.php");
            exit; // Stop further execution
        } else {
            $_SESSION['ERROR'] = "User Type Reg failed, UNKNOWN ERROR";
            header("Location: add_usertype.php");
            exit; // Stop further execution
        }
    } catch (Exception $e) {
        // Handle database error within reg_admin or here.
        $_SESSION['ERROR'] = "USER TYPE REG ERROR: " . $e->getMessage();
        header("Location: add_usertype.php");
        exit; // Stop further execution
    }
}


echo "<!DOCTYPE html>";

echo "<html lang='en'>";

echo "<head>";
echo "<link rel='stylesheet' href='admin_styles.css'>";
echo "<title> RZL Add User Type</title>";
echo "</head>";

echo "<body>";

echo "<div id='container'>";

echo "<div id='title'>";

echo "<h3 id='banner'>RZL Add User Type</h3>";

echo "</div>";

include 'admin_nav.php';  // includes the needed nav bar

echo "<div id='content'>";

echo "<h4> Add New User Type </h4>";

echo "<br>";

echo admin_error($_SESSION);

echo "<br>";

echo "<form method='post' action='add_usertype.php'>";  //post method is important to send the info to the ticket reg page

echo "<input type='text' name='type' placeholder='User Type' required><br>";

echo "<input type='text' name='discount' placeholder='Discount to apply' required><br>";

echo "<input type='submit' name='submit' value='Submit'>";

echo "<br><br>";

echo "</div>";

echo "</div>";

echo "</body>";

echo "</html>";
