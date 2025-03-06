<?php

session_start();
require_once 'dbconnect.php';
require_once 'common_functions.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    try {
        // Prepare and execute the SQL query
        $conn = db_connect();
        $sql = "INSERT INTO ticket (ticket, price, num) VALUES (?, ?, ?)";  //prepare the sql to be sent
        $stmt = $conn->prepare($sql); //prepare to sql

        $stmt->bindParam(1, $_POST['ticket']);  //bind parameters for security
        $stmt->bindParam(2, $_POST['price']);
        $stmt->bindParam(3, $_POST['num']);

        $stmt->execute();  //run the query to insert
        $conn = null;  // closes the connection so cant be abused.
        $_SESSION['message'] = "Ticket type registered successfully";
        header("Location: add_ticket.php");
    }  catch (PDOException $e) {
        // Handle database errors
        error_log("Ticket Reg Database error: " . $e->getMessage()); // Log the error
        throw new Exception("Ticket Reg Database error". $e); //Throw exception for calling script to handle.
    } catch (Exception $e) {
        // Handle validation or other errors
        error_log("Ticket Registration error: " . $e->getMessage()); //Log the error
        throw new Exception("Ticket Registration error: " . $e->getMessage()); //Throw exception for calling script to handle.
    }

}

echo "<!DOCTYPE html>";

echo "<html lang='en'>";

echo "<head>";
echo "<link rel='stylesheet' href='styles.css'>";
echo "<title> Ticket Booking </title>";
echo "</head>";

echo "<body>";

echo "<div id='container'>";

require_once 'title.php';

require_once 'nav.php';

echo "<div id='content'>";

echo "<h4> Ticket Booking </h4>";

echo "<br>";

echo usr_error($_SESSION);

echo "<br>";

echo "<br>";

echo "<form method='post' action='ticket_booking.php'>";


echo "<select name='ticket_type'>";
$ticket_types = get_ticket_types(db_connect());

foreach ($ticket_types as $type) {
    echo "<option value=".$type['ticketid'].">".$type['ticket']."</option>";
}

echo "</select><br>";

echo " <input type='date' name='booking_date' value='2025-03-15' min='2025-03-04' max='2025-11-30' />";

echo "<input type='text' name='num' placeholder='number of tickets' required><br>";

echo "<input type='submit' name='submit' value='Register'>";

echo "<br><br>";

echo "<br><br>";

echo "</div>";

echo "</div>";

echo "</body>";

echo "</html>";