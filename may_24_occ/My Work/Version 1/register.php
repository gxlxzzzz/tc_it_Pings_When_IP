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
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // First, include the database connection for SELECT
        include "dbconnect/db_connect_select.php"; // Database connection for select
    } catch (PDOException $e) {
        echo "Connection error: " . $e->getMessage();
        exit();
    }

    // Sanitize inputs using filter_input
    $usnm = filter_input(INPUT_POST, 'username');
    $pswd = filter_input(INPUT_POST, 'password');
    $cpswd = filter_input(INPUT_POST, 'cpassword');
    $fname = filter_input(INPUT_POST, 'fname');
    $sname = filter_input(INPUT_POST, 'sname');
    $email = filter_input(INPUT_POST, 'email');
    $signupdate = date("Y-m-d"); // Full year format

    // Check if passwords match
    if ($pswd != $cpswd) {
        echo "<p>Your passwords do not match</p>";
    } elseif (strlen($pswd) < 8) {
        echo "<p>Password must be at least 8 characters long</p>";
    } else {
        try {
            // Check if the username already exists using SELECT query
            $sql = "SELECT username FROM user WHERE username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $usnm);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                echo "<p>User exists, try another name</p>";
            } else {
                // If username doesn't exist, proceed to insert the new user
                try {
                    // Now, include the database connection for INSERT
                    include "dbconnect/db_connect_insert.php"; // Database connection for insert

                    // Hash the password before inserting into the database
                    $hpswd = password_hash($pswd, PASSWORD_DEFAULT);

                    $signupdate = date("Y-m-d"); // Correct format for DATE
                    // Insert query with correct column names
                    $sql = "INSERT INTO user (username, password, f_name, s_name, email, signup) VALUES (?, ?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(1, $usnm);
                    $stmt->bindParam(2, $hpswd);
                    $stmt->bindParam(3, $fname);
                    $stmt->bindParam(4, $sname);
                    $stmt->bindParam(5, $email);
                    $stmt->bindParam(6, $signupdate);

                    $stmt->execute();
                    echo "<p>Successfully registered</p>";
                    header("Location: login.php?success=registered"); // Redirect to login page after successful registration
                    exit();
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>


</body>
</html>
