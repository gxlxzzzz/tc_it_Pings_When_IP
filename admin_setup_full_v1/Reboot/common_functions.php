<?php

function usr_error(&$session){
    if(isset($session['message'])) {
        $temp = $session['message'];
        unset($session['message']);
        return $temp;
    } else {
        return "";
    }
}

function get_ticket_types($conn){
    try {
        $sql = "SELECT ticketid, ticket FROM ticket"; //set up the sql statement
        $stmt = $conn->prepare($sql); //prepares
        $stmt->execute(); //run the sql code
        $result = $stmt->fetchall(PDO::FETCH_ASSOC);  //brings back results

        return $result;
    }
    catch (PDOException $e) { //catch error
        // Log the error (crucial!)
        error_log("Database error in get ticket type: " . $e->getMessage());
        // Throw the exception
        throw $e; // Re-throw the exception
    }
}