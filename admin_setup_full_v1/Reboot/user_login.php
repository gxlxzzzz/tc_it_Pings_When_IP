<?php
session_start();

require_once 'common_functions.php';

if (isset($_SESSION['user_ssnlogin'])){
    $_SESSION['message'] = "You are already logged in!";
    header("Location: index.php");
    exit; // Stop further execution
}

elseif ($_SERVER['REQUEST_METHOD'] === 'POST'){
    require_once 'dbconnect.php';

    // if superuser doesn't exist and posted to this page
    try {  //try this code, catch errors
        $conn = db_connect(); // establish connection to database
        $sql = "SELECT * FROM user WHERE username = ?"; //set up the sql statement
        $stmt = $conn->prepare($sql); //prepares
        $stmt->bindParam(1,$_POST['username']);  //binds the parameters to execute
        $stmt->execute(); //run the sql code
        $result = $stmt->fetch(PDO::FETCH_ASSOC);  //brings back results
        $conn = null;  // nulls off the connection so cant be abused.

        if($result){  // if there is a result returned

            if (password_verify($_POST["password"], $result["password"]))  { // verifies the password is matched
                $_SESSION["user_ssnlogin"] = true;  // sets up the session variables
                $_SESSION["username"] = $_POST['username'];
                $_SESSION["userid"] = $result["userid"];
                $_SESSION['message'] = "User Successfully Logged In";
                header("location:index.php");  //redirect on success
                exit();

            } else{
                $_SESSION['message'] = "User login passwords not match";
                header("Location: user_login.php");
                exit; // Stop further execution
            }

        } else {
            $_SESSION['message'] = "User not found";
            header("Location: user_login.php");
            exit; // Stop further execution

        }

    } catch (Exception $e) {
        $_SESSION['message'] = "User login".$e->getMessage();
        header("Location: user_login.php");
        exit; // Stop further execution
    }
}
else {

    echo "<!DOCTYPE html>";

    echo "<html lang='en'>";

    echo "<head>";

    echo "<link rel='stylesheet' href='styles.css'>";

    echo "<title> RZL User Login</title>";

    echo "</head>";

    echo "<body>";

    echo "<div id='container'>";

    require_once 'title.php';

    require_once 'nav.php';

    echo "<div id='content'>";

    echo "<h4> User Login</h4>";

    echo "<br>";

    echo usr_error($_SESSION);

    echo "<form method='post' action='user_login.php'>";

    echo "<input type='text' name='username' placeholder='Username' required><br>";

    echo "<input type='password' name='password' placeholder='Password' required><br>";

    echo "<input type='submit' name='submit' value='Login'>";

    echo "<br><br>";

    echo "</div>";

    echo "</div>";

    echo "</body>";

    echo "</html>";
}