<?php
// page to allow users to register to the system

session_start();  // connect to session if one has started

require_once 'dbconnect/db_connect_master.php';  // include once the db connect functions
require_once 'common_functions.php';  // include the main functions


if ($_SERVER['REQUEST_METHOD'] === 'POST') {  // if it's a post method
    // used to check correct format of email address
    if (only_user(dbconnect_select(),$_POST['username'])) {  //calls function to check password complexity
        $_SESSION['ERROR'] = "Cannot use that username";
        header("Location: user_reg.php");
        exit; // Stop further execution
    }
   elseif (!pwrd_checker($_POST['password'], $_POST['cpassword'])) {  //calls function to check password complexity
        $_SESSION['ERROR'] = "Password related issue, try again";
        header("Location: user_reg.php");
        exit; // Stop further execution
    } else {
// this code runs if the previous checks are ok
        try {
            $long_task = $_POST['username']." registered as a new user";
            if(reg_user(dbconnect_insert(),$_POST) && auditor(dbconnect_insert(), $_POST['username'], "USERREG", $long_task)) { // Assuming $conn is your database connection
                $_SESSION['SUCCESS'] = $_POST['username']." USER REGISTERED";
                header("Location: user_login.php");
                exit; // Stop further execution
            } else {
                $_SESSION['ERROR'] = "ADD USER FAIL, UNKNOWN ERROR";
                header("Location: user_reg.php");
                exit; // Stop further execution
            }
        }
        catch(Exception $e) {
            // Handle database error within reg_admin or here.
            $_SESSION['ERROR'] = "SUPER REG ERROR: ". $e->getMessage();
            header("Location: admin_index.php");
            exit; // Stop further execution
        }
    }

}
else {

    echo "<!DOCTYPE html>";

    echo "<html lang='en'>";

    echo "<head>";
    echo "<title> RZL User Registration</title>";
    echo "<link rel='stylesheet' href='styles.css'>";
    echo "</head>";

    echo "<body>";

    echo "<div id='container'>";

    echo "<div id='title'>";

    echo "<h3 id='banner'>RZL User Registration</h3>";

    echo "</div>";

    include 'user_nav.php';

    echo "<div id='content'>";

    echo "<h4> New User Registration </h4>";

    echo "<br>";

    echo usr_error($_SESSION);

    echo "<br>";

    echo "<form method='post' action='user_reg.php'>";

    echo "<input type='text' name='username' placeholder='Username' required><br>";

    echo "<input type='password' name='password' placeholder='Password' required><br>";

    echo "<input type='password' name='cpassword' placeholder='Confirm Password' required><br>";

    echo "<input type='text' name='fname' placeholder='First Name' required><br>";

    echo "<input type='text' name='sname' placeholder='Surname' required><br>";



    echo "<label for='user-type'>Select User Type:</label>";
    echo "<select name='user_type'>";
    $user_types = get_user_types(dbconnect_select());

    foreach ($user_types as $type) {
        echo "<option value=".$type['user_type_id'].">".$type['type']."</option>";
    }

    echo "</select><br>";

    echo "<input type='submit' name='submit' value='Register'>";

    echo "<br><br>";

    echo "</div>";

    echo "</div>";

    echo "</body>";

    echo "</html>";
}