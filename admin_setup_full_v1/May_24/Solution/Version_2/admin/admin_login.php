<?php
session_start();

require_once 'admin_functions.php';
require_once '../dbconnect/db_connect_master.php';
require_once '../common_functions.php';

if (isset($_SESSION['admin_ssnlogin'])){
    $_SESSION['ERROR'] = "Admin already logged in";
    header("Location: admin_index.php");
    exit; // Stop further execution
}

elseif ($_SERVER['REQUEST_METHOD'] === 'POST'){  // if superuser doesn't exist and posted to this page
    try {  //try this code, catch errors

        $conn = dbconnect_select();
        $sql = "SELECT password, priv FROM admin_users WHERE username = ?"; //set up the sql statement
        $stmt = $conn->prepare($sql); //prepares
        $stmt->bindParam(1,$_POST['username']);  //binds the parameters to execute
        $stmt->execute(); //run the sql code
        $result = $stmt->fetch(PDO::FETCH_ASSOC);  //brings back results
        $conn = null;  // nulls off the connection so cant be abused.

        if($result){  // if there is a result returned
            $short_code = $result["priv"]."login";
            $long_code = $_POST['username']." ".$result["priv"]." login";

            if (password_verify($_POST["password"], $result["password"]) && auditor(dbconnect_insert(), $_POST['username'], $short_code, $long_code)) { // verifies the password is matched
                $_SESSION["admin_ssnlogin"] = true;  // sets up the session variables
                $_SESSION["username"] = $_POST['username'];
                $_SESSION["priv"] = $result["priv"];
                $_SESSION['SUCCESS'] = "Admin Successfully Logged In";
                header("location:admin_index.php");  //redirect on success
                exit();

            } else{
                $_SESSION['ERROR'] = "Admin login passwords not match";
                header("Location: admin_login.php");
                exit; // Stop further execution
            }

        } else {
            $_SESSION['ERROR'] = "Admin user not found";
            header("Location: admin_login.php");
            exit; // Stop further execution

        }

    } catch (Exception $e) {
        $_SESSION['ERROR'] = "Admin login".$e->getMessage();
        header("Location: admin_login.php");
        exit; // Stop further execution
    }
}
else {

    echo "<!DOCTYPE html>";

    echo "<html lang='en'>";

    echo "<head>";

    echo "<link rel='stylesheet' href='admin_styles.css'>";

    echo "<title> RZL Admin Login</title>";

    echo "</head>";

    echo "<body>";

    echo "<div id='list container'>";

    echo "<div id='title'>";

    echo "<h3 id='banner'>RZL Admin System</h3>";

    echo "</div>";

    echo "<div id='content'>";

    echo "<h4> Admin Login</h4>";

    echo "<br>";

    echo admin_error($_SESSION);

    echo "<form method='post' action='admin_login.php'>";

    echo "<input type='text' name='username' placeholder='Username' required><br>";

    echo "<input type='password' name='password' placeholder='Password' required><br>";

    echo "<input type='submit' name='submit' value='Login'>";

    echo "<br><br>";

    echo "</div>";

    echo "</div>";

    echo "</body>";

    echo "</html>";
}