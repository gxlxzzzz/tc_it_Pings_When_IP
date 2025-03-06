<?php

function super_checker($conn){
    try {
        $sql = "SELECT priv FROM admin_users WHERE priv = 'SUPER'"; //set up the sql statement
        $stmt = $conn->prepare($sql); //prepares
        //$stmt->bindParam(1, "SUPER");
        $stmt->execute(); //run the sql code
        $result = $stmt->fetch(PDO::FETCH_ASSOC);  //brings back results
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    catch (PDOException $e) { //catch error
        // Log the error (crucial!)
        error_log("Database error in super_checker: " . $e->getMessage());
        // Throw the exception
        throw $e; // Re-throw the exception
    }
}

function reg_admin($conn, $post) {

    // Validate the post data
    if (!isset($post['username'], $post['password'], $post['fname'], $post['sname'], $post['email'], $post['priv'])) {
        throw new Exception("Missing required fields.");
    } elseif(valid_email($post['email'])){
        try {
            // Prepare and execute the SQL query
            $sql = "INSERT INTO admin_users (username, password, email, f_name, s_name, signup_date, priv) VALUES (?, ?, ?, ?, ?, ?, ?)";  //prepare the sql to be sent
            $stmt = $conn->prepare($sql); //prepare to sql

            $stmt->bindParam(1, $post['username']);  //bind parameters for security
            // Hash the password
            $hpswd = password_hash($post['password'], PASSWORD_DEFAULT);  //has the password
            $stmt->bindParam(2, $hpswd);
            $stmt->bindParam(3, $post['email']);
            $stmt->bindParam(4, $post['fname']);
            $stmt->bindParam(5, $post['sname']);
            $signup_date = time();
            $stmt->bindParam(6, $signup_date);
            $stmt->bindParam(7, $post['priv']);

            $stmt->execute();  //run the query to insert
            $conn = null;  // closes the connection so cant be abused.
            return true; // Registration successful
        }  catch (PDOException $e) {
            // Handle database errors
            error_log("Database error: " . $e->getMessage()); // Log the error
            throw new Exception("Database error". $e); //Throw exception for calling script to handle.
        } catch (Exception $e) {
            // Handle validation or other errors
            error_log("Registration error: " . $e->getMessage()); //Log the error
            throw new Exception("Registration error: " . $e->getMessage()); //Throw exception for calling script to handle.
        }
    }
    else {
        error_log("Registration email wrong format"); //Log the error
        throw new Exception("Registration email wrong format"); //Throw exception for calling script to handle.
    }
}

function valid_email($email){
    $phrase = "@rzl.com";
    if(strpos($email, $phrase) == false){
        return false;
    } else {
        return true;
    }
}

function admin_error(&$session){  // uses passes by reference no by value, so you can edit the session variable data properly

    if(isset($session['ERROR'])){  // checks for the session variable being set with an error
        $error = 'ERROR: '. $session['ERROR'];  //echos out the stored error from session
        $session['ERROR'] = "";
        unset($session['ERROR']);  //
        return $error;
    }
    elseif(isset($session['SUCCESS'])){  // checks for the session variable being set with an error
        $success = 'SUCCESS: '. $session['SUCCESS'];  //echos out the stored error from session
        $session['SUCCESS'] = "";
        unset($session['SUCCESS']);  //
        return $success;
    }
    else {
        return "";
    }
}

function add_ticket($conn,$post){
    // Validate the post data
    if (!isset($post['type'], $post['price'], $post['no_of_tickets'])) {
        throw new Exception("Missing required fields.");
    }
    else {
            try {
                // Prepare and execute the SQL query
                $sql = "INSERT INTO tickets (type, price, no_of_tickets) VALUES (?, ?, ?)";  //prepare the sql to be sent
                $stmt = $conn->prepare($sql); //prepare to sql

                $stmt->bindParam(1, $post['type']);  //bind parameters for security
                $stmt->bindParam(2, $post['price']);
                $stmt->bindParam(3, $post['no_of_tickets']);

                $stmt->execute();  //run the query to insert
                $conn = null;  // closes the connection so cant be abused.
                return true; // Registration successful
            } catch (PDOException $e) {
                // Handle database errors
                error_log("Add Ticket Database error: " . $e->getMessage()); // Log the error
                throw new Exception("Add Ticket Database error" . $e); //Throw exception for calling script to handle.
            } catch (Exception $e) {
                // Handle validation or other errors
                error_log("Add Ticket Registration error: " . $e->getMessage()); //Log the error
                throw new Exception("Add Ticket Registration error: " . $e->getMessage()); //Throw exception for calling script to handle.
            }
        }


}

function add_hotelroom($conn,$post){
    // Validate the post data
    if (!isset($post['type'], $post['occupancy'], $post['no_of_rooms'], $post['price'])) {
        throw new Exception("Missing required fields.");
    }
    else {
        try {
            // Prepare and execute the SQL query
            $sql = "INSERT INTO hotel_rooms (type, occupancy, no_of_rooms, price) VALUES (?, ?, ?, ?)";  //prepare the sql to be sent
            $stmt = $conn->prepare($sql); //prepare to sql

            $stmt->bindParam(1, $post['type']);  //bind parameters for security
            $stmt->bindParam(2, $post['occupancy']);
            $stmt->bindParam(3, $post['no_of_rooms']);
            $stmt->bindParam(4, $post['price']);

            $stmt->execute();  //run the query to insert
            $conn = null;  // closes the connection so cant be abused.
            return true; // Registration successful
        } catch (PDOException $e) {
            // Handle database errors
            error_log("Add Room Database error: " . $e->getMessage()); // Log the error
            throw new Exception("Add Ticket Database error" . $e); //Throw exception for calling script to handle.
        } catch (Exception $e) {
            // Handle validation or other errors
            error_log("Add Room Registration error: " . $e->getMessage()); //Log the error
            throw new Exception("Add Ticket Registration error: " . $e->getMessage()); //Throw exception for calling script to handle.
        }
    }

}

function add_usertype($conn,$post){
    // Validate the post data
    if (!isset($post['type'], $post['discount'])) {
        throw new Exception("Missing required fields.");
    }
    else {
        try {
            // Prepare and execute the SQL query
            $sql = "INSERT INTO user_type (type, discount) VALUES (?, ?)";  //prepare the sql to be sent
            $stmt = $conn->prepare($sql); //prepare to sql

            $stmt->bindParam(1, $post['type']);  //bind parameters for security
            $stmt->bindParam(2, $post['discount']);

            $stmt->execute();  //run the query to insert
            $conn = null;  // closes the connection so cant be abused.
            return true; // Registration successful
        } catch (PDOException $e) {
            // Handle database errors
            error_log("Add User Type Database error: " . $e->getMessage()); // Log the error
            throw new Exception("Add User Type Database error" . $e); //Throw exception for calling script to handle.
        } catch (Exception $e) {
            // Handle validation or other errors
            error_log("Add User Type Registration error: " . $e->getMessage()); //Log the error
            throw new Exception("Add User Type Registration error: " . $e->getMessage()); //Throw exception for calling script to handle.
        }
    }
}