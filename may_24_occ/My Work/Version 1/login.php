<?php
// temporary logging test for database connection ensuring the connection was successful in V1
try {
    include "dbconnect/db_connect_select.php";
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection error";
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>

<ul>
    <!-- This is a minimal Functionality navigation bar to navigate between pages -->
    <li><a href="index.php">Home</a></li>
    <li><a href="login.php">Login</a></li>
    <li><a href="register.php">Register</a></li>
</ul>

<form class="form-container" method="POST" action="">
    <div class="form-group">
        <label for="uname">Username:</label>
        <input type="text" id="username" name="username" placeholder="Enter Username" required>
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter Password" required>
    </div>
    <button type="submit">Login</button>
</form>

<?php
// Include database connection
include "dbconnect/db_connect_select.php";

// Start session
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input values
    $usnm = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $pswd = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    // Check if both username and password are provided
    if (!empty($usnm) && !empty($pswd)) {
        try {
            // Prepare SQL query securely
            $sql = "SELECT * FROM user WHERE username = :username";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':username', $usnm);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // Check if user exists and verify password
            if ($result && password_verify($pswd, $result['password'])) {
                // Start session and store user data
                $_SESSION['user_id'] = $result['id'];
                $_SESSION['username'] = $result['username'];

                // Redirect to dashboard after successful login
                header("Location: dashboard.php");
                exit();
            } else {
                // Invalid username or password
                header("Location: login.php?error=invalid_credentials");
                exit();
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        // Missing credentials, redirect back to login page
        header("Location: login.php?error=missing_credentials");
        exit();
    }
}
?>
</body>
</html>
