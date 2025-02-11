<?php
try {
    include "db_connect.php"; // Reference to the database connection file
    //echo "Connected successfully"; For testing DB connection
} catch (PDOException $e) {
    //echo "Connection error"; For testing DB connection
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>RLA Splash Screen</title>
</head>
<body>
<ul>
<!-- This is a minimal Functionality navigation bar to navigate between pages -->
    <li><a href="index.php">Home</a></li>
    <li><a href="login.php">Login</a></li>
    <li><a href="register.php">Register</a></li>
</ul>
<p> This is a version 3 feature of schpiel etc</p>
<!--This Page will be expanded on in version 3 as it is only a splash page and not a functional Requirement-->
</body>