<?php

session_start();

require_once "common_functions.php";
require_once "dbconnect/db_connect_master.php";

if (!isset($_SESSION['user_ssnlogin'])){
    $_SESSION['ERROR'] = "You are not logged in!";
    header("Location: user_login.php");
    exit; // Stop further execution
} elseif($_SERVER["REQUEST_METHOD"] == "POST"){
     if(avail_tickets(dbconnect_select(),$_POST)){
         echo "You can book them";
     }
     else {
         echo " not enough tickets to spare";
     }

}


echo "<!DOCTYPE html>";

echo "<html lang='en'>";

echo "<head>";
echo "<link rel='stylesheet' href='styles.css'>";
echo "<title> RZA Ticket Booking</title>";
echo "</head>";

echo "<body>";

echo "<div id='container'>";

echo "<div id='title'>";

echo "<h3 id='banner'>Ridget Zoo Adventures</h3>";

echo "</div>";

include 'user_nav.php';

echo "<div id='content'>";

echo "<h4> Ticket Booking System</h4>";

echo "<br>";
echo usr_error($_SESSION);
echo "<br>";


echo "<br>";
echo "<br>";

echo "<form method='post' action='book_tickets.php'>";

echo "<table id='tick_book'>";
echo "<tr>";
    echo "<td> Select a date: </td>";

    echo "<td> <input type='date' name='booking_date' value='2025-03-15' min='2025-03-04' max='2025-11-30' /></td>";
echo "</tr>";

echo "<tr>";
    echo "<td> How many Tickets: </td>";
    echo "<td><input type='text' name='num' placeholder='number of tickets' required><br></td>";
echo "</tr>";

echo "<tr>";
    echo "<td> Select Ticket type: </td>";
    echo "<td><select name='ticket_type'>";

    $ticket_types = get_ticket_types(dbconnect_select());

    foreach ($ticket_types as $type) {
        echo "<option value=".$type['t_id'].">".$type['type']."</option>";
    }

    echo "</select></td><br>";
echo "</tr>";

echo "<tr>";
    echo "<td></td><td><input type='submit' name='submit' value='Book'></td>";
echo "</tr>";

echo "</table>";
echo "</form>";

echo "<br><br>";

echo "</div>";

echo "</div>";

echo "</body>";

echo "</html>";



