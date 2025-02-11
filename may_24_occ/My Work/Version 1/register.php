<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration</title>
</head>
<body>

<ul>
    <!-- This is a minimal Functionality navigation bar to navigate between pages -->
    <li><a href="index.php">Home</a></li>
    <li><a href="login.php">Login</a></li>
    <li><a href="register.php">Register</a></li>
</ul>

<form class="form-container" method="POST" action="register.php">
    <div class="form-group">
        <label for="Username">Username:</label>
        <input type="text" id="Username" name="username" placeholder="Enter Username" required>
    </div>
    <div class="form-group">
        <label for="Password">Password:</label>
        <input type="password" id="Sign_Password" name="password" placeholder="Enter Password" required>
    </div>
    <div class="form-group">
        <label for="ConfirmPassword">Confirm Password:</label>
        <input type="password" id="ConfirmPassword" name="cpassword" placeholder="Retype Password" required>
    </div>
    <div class="form-group">
        <label for="Fname">First Name:</label>
        <input type="text" id="Fname" name="fname" placeholder="Enter First Name" required>
    </div>
    <div class="form-group">
        <label for="Sname">Surname:</label>
        <input type="text" id="Sname" name="sname" placeholder="Enter Surname" required>
    </div>
    <div class="form-group">
        <label for="Email">Email:</label>
        <input type="email" id="Email" name="email" placeholder="Enter Email" required>
    </div>
    <button type="submit">Register</button>
</form>

</body>
</html>


<?php

try {
    include "db_connect.php";
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection error";
}


// Sanitize inputs using filter_input
$usnm = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$pswd = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$cpswd = filter_input(INPUT_POST, 'cpassword', FILTER_SANITIZE_STRING);
$fname = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING);
$sname = filter_input(INPUT_POST, 'sname', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$signupdate = date("Y-m-d");  // Full year format

if($pswd != $cpswd){
    header("Location: register.php?error=password_mismatch");
    echo "<br>Your passwords do not match";
} elseif(strlen($pswd) < 8){
    header("Location: register.php?error=password_short");
    echo "<br>Password must be at least 8 characters long";
} else {
    try {
        // Corrected column name 'username'
        $sql = "SELECT username FROM user WHERE uname = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $usnm);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result){
            header("Location: register.php?error=user_exists");
            echo "<br>User exists, try another name";
        } else {
            try {
                // Hash the password before inserting into the database
                $hpswd = password_hash($pswd, PASSWORD_DEFAULT);
                // Insert query with correct column names
                $sql = "INSERT INTO users (username, password, fname, sname, email, signup) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $usnm);
                $stmt->bindParam(2, $hpswd);
                $stmt->bindParam(3, $fname);
                $stmt->bindParam(4, $sname);
                $stmt->bindParam(5, $email);
                $stmt->bindParam(6, $signupdate);

                $stmt->execute();
                header("Location: login.php?success=registered");
                echo "<br>Successfully registered";
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>
