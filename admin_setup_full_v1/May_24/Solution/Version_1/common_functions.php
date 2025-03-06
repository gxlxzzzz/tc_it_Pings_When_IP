<?php


function auditor($conn, $who, $short_what, $long_what){

    try {
        // Prepare and execute the SQL query
        $sql = "INSERT INTO audit (username, taskcode, task, date) VALUES (?, ?, ?, ?)";  //prepare the sql to be sent
        $stmt = $conn->prepare($sql); //prepare to sql

        $stmt->bindParam(1, $who);  //bind parameters for security
        $stmt->bindParam(2, $short_what);
        $stmt->bindParam(3, $long_what);
        $task_date = time();
        $stmt->bindParam(4, $task_date);
        $stmt->execute();  //run the query to insert
        $conn = null;  // closes the connection so cant be abused.
        return true; // Registration successful
    }  catch (PDOException $e) {
        // Handle database errors
        error_log("Audit Database error: " . $e->getMessage()); // Log the error
        throw new Exception(" Audit Database error". $e); //Throw exception for calling script to handle.
    } catch (Exception $e) {
        // Handle validation or other errors
        error_log("Auditing error: " . $e->getMessage()); //Log the error
        throw new Exception("Auditing error: " . $e->getMessage()); //Throw exception for calling script to handle.
    }

}


function pwrd_checker($pass, $cpass) {  //takes in 2 parameters

    if($pass!=$cpass){  // do the passwords not match
        return false; // return false
    }
    elseif(strlen($pass)<8){  // is the password long enough?
        return false;
    }
    else{
        return true;
    }
}


function usr_error(&$session){

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


function only_user($conn, $username){
    try {
        $sql = "SELECT username FROM user WHERE username = ?"; //set up the sql statement
        $stmt = $conn->prepare($sql); //prepares
        $stmt->bindParam(1, $username);
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
        error_log("Database error in only_user: " . $e->getMessage());
        // Throw the exception
        throw $e; // Re-throw the exception
    }
}


function get_user_types($conn){
    try {
        $sql = "SELECT user_type_id, type FROM user_type"; //set up the sql statement
        $stmt = $conn->prepare($sql); //prepares
        $stmt->execute(); //run the sql code
        $result = $stmt->fetchall(PDO::FETCH_ASSOC);  //brings back results

        return $result;
    }
    catch (PDOException $e) { //catch error
        // Log the error (crucial!)
        error_log("Database error in super_checker: " . $e->getMessage());
        // Throw the exception
        throw $e; // Re-throw the exception
    }
}


function reg_user($conn,$post){
    if (!isset($post['username'], $post['password'], $post['fname'], $post['sname'], $post['user_type'])) {
        throw new Exception("Missing required fields.");
    } else{
        try {
            // Prepare and execute the SQL query
            $sql = "INSERT INTO user (username, password, f_name, s_name, signupdate, user_type_id) VALUES (?, ?, ?, ?, ?, ?)";  //prepare the sql to be sent
            $stmt = $conn->prepare($sql); //prepare to sql

            $stmt->bindParam(1, $post['username']);  //bind parameters for security
            // Hash the password
            $hpswd = password_hash($post['password'], PASSWORD_DEFAULT);  //has the password
            $stmt->bindParam(2, $hpswd);
            $stmt->bindParam(3, $post['fname']);
            $stmt->bindParam(4, $post['sname']);
            $signup_date = time();
            $stmt->bindParam(5, $signup_date);
            $stmt->bindParam(6, $post['user_type']);

            $stmt->execute();  //run the query to insert
            $conn = null;  // closes the connection so cant be abused.
            return true; // Registration successful
        }  catch (PDOException $e) {
            // Handle database errors
            error_log("User Reg Database error: " . $e->getMessage()); // Log the error
            throw new Exception("User Reg Database error". $e); //Throw exception for calling script to handle.
        } catch (Exception $e) {
            // Handle validation or other errors
            error_log("User Registration error: " . $e->getMessage()); //Log the error
            throw new Exception("User Registration error: " . $e->getMessage()); //Throw exception for calling script to handle.
        }
    }

}