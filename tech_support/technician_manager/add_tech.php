<?php
    session_start();
    // get the data from the database
    $firstName = filter_input(INPUT_POST, 'firstName');
    $lastName = filter_input(INPUT_POST, 'lastName');
    $email = filter_input(INPUT_POST, 'email');
    $phone = filter_input(INPUT_POST, 'phone');
    $password = filter_input(INPUT_POST, 'password');

    switch (true) {

        case ($firstName == null || $lastName == null || 
             $email == null || $phone == null || $password == null): 

            $_SESSION["add_error"] = "Invalid data. Check all
                fields and try again.";

            $url = "../errors/error.php";
            header("Location: " . $url);
            die();
        break;
        
        default:
            require_once('../model/database.php');

            $query = 'INSERT INTO technicians
                (firstName, lastName, email, phone, password)
                VALUES
                (:firstName, :lastName, :email, :phone, :password)';

            $statement = $db->prepare($query);
            $statement->bindValue(':firstName', $firstName);
            $statement->bindValue(':lastName', $lastName);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':phone', $phone);
            $statement->bindValue(':password', $password);

            $statement->execute();
            $statement->closeCursor();
        break;
        }

        $url = "index.php";
        header("Location: " . $url);
        die();
?>