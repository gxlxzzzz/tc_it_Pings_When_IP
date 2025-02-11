<?php
// temporary logging test for database connection ensuring the connection was successful in V1
try {
    include "../dbconnect/db_connect_select.php";
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
    <title>Document</title>
</head>
<body>

    <ul>
        <!-- This is a minimal Functionality navigation bar to navigate between pages -->
        <li><a href="index.php">Home</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
    </ul>

    <form class="form-container" method="POST" action="login.php">
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
</body>
</html>
