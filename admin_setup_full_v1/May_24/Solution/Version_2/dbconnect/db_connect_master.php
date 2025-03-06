<?php

function dbconnect_delete(){
    $servername = "localhost";  //sets servername

    $dbusername = "rzldelete";

    $dbpassword = "rzldelete";  //password for database useraccount

    $dbname = "zoouser";  //database name to connect to

    try {  //attempt this block of code, catching an error
        $conn = new PDO("mysql:host=$servername;port=3306;dbname=$dbname", $dbusername, $dbpassword);  // creates a PDO connection to the database
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //sets error modes
        return $conn;
    } catch(PDOException $e) {  //catch statement if it fails
        error_log("Database error in super_checker: " . $e->getMessage());
        // Throw the exception
        throw $e; // Re-throw the exception  // outputs the error
    }
}

function dbconnect_insert(){
    $servername = "localhost";  //sets servername

    $dbusername = "rzlinsert"; // had to change this variable name as it fought against the admin reg and user reg

    $dbpassword = "rzlinsert";  //password for database useraccount

    $dbname = "zoouser";  //database name to connect to

    try {  //attempt this block of code, catching an error
        $conn = new PDO("mysql:host=$servername;port=3306;dbname=$dbname", $dbusername, $dbpassword);  // creates a PDO connection to the database
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //sets error modes
        return $conn;
    } catch(PDOException $e) {  //catch statement if it fails
        error_log("Database error in super_checker: " . $e->getMessage());
        // Throw the exception
        throw $e; // Re-throw the exception  // outputs the error
    }
}

function dbconnect_select(){

    $servername = "localhost";  //sets servername

    $dbusername = "rzlselect";  // had to change this variable name as it fought against the admin reg and user reg

    $dbpassword = "rzlselect";  //password for database useraccount

    $dbname = "zoouser";  //database name to connect to

    try {  //attempt this block of code, catching an error
        $conn = new PDO("mysql:host=$servername;port=3306;dbname=$dbname", $dbusername, $dbpassword);  // creates a PDO connection to the database
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //sets error modes
        return $conn;
    } catch(PDOException $e) {  //catch statement if it fails
        error_log("Database error in super_checker: " . $e->getMessage());
        // Throw the exception
        throw $e; // Re-throw the exception  // outputs the error
    }
}

function dbconnect_update(){
    $servername = "localhost";  //sets servername

    $dbusername = "rzlupdate";  // had to change this variable name as it fought against the admin reg and user reg

    $dbpassword = "rzlupdate";  //password for database useraccount

    $dbname = "zoouser";  //database name to connect to

    try {  //attempt this block of code, catching an error
        $conn = new PDO("mysql:host=$servername;port=3306;dbname=$dbname", $dbusername, $dbpassword);  // creates a PDO connection to the database
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //sets error modes
        return $conn;
    } catch(PDOException $e) {  //catch statement if it fails
        error_log("Database error in super_checker: " . $e->getMessage());
        // Throw the exception
        throw $e; // Re-throw the exception  // outputs the error
    }
}