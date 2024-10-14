<?php
    session_start();

    $customerID = filter_input(INPUT_POST, 'customerID');
    $firstName = filter_input(INPUT_POST, 'firstName');
    $lastName = filter_input(INPUT_POST, 'lastName');
    $address = filter_input(INPUT_POST, 'address');
    $city = filter_input(INPUT_POST, 'city');
    $province = filter_input(INPUT_POST, 'province');
    $postalCode = filter_input(INPUT_POST, 'postalCode');
    $countryCode = filter_input(INPUT_POST, 'countryCode');
    $phone = filter_input(INPUT_POST, 'phone');
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');

    switch (true) {
        case ($firstName == null):
            $_SESSION["add_error"] = "First Name is required.";
            break;

        case ($lastName == null):
            $_SESSION["add_error"] = "Last Name is required.";
            break;

        case ($address == null):
            $_SESSION["add_error"] = "Address is required.";
            break;

        case ($city == null):
            $_SESSION["add_error"] = "City is required.";
            break;

        case ($province == null):
            $_SESSION["add_error"] = "Province is required.";
            break;

        case ($postalCode == null):
            $_SESSION["add_error"] = "Postal Code is required.";
            break;

        case ($countryCode == null):
            $_SESSION["add_error"] = "Country Code is required.";
            break;

        case ($phone == null):
            $_SESSION["add_error"] = "Phone number is required.";
            break;

        case ($email == null):
            $_SESSION["add_error"] = "Email is required.";
            break;

        default:
            require_once('../model/database.php');

            $query = 'UPDATE customers
                SET firstName = :firstName, 
                    lastName = :lastName, 
                    address = :address,
                    city = :city, 
                    province = :province, 
                    postalCode = :postalCode, 
                    countryCode = :countryCode, 
                    phone = :phone, 
                    email = :email, 
                    password = :password 
                    WHERE customerID = :customerID';

            $statement = $db->prepare($query);
            $statement->bindValue(':customerID', $customerID);
            $statement->bindValue(':firstName', $firstName);
            $statement->bindValue(':lastName', $lastName);
            $statement->bindValue(':address', $address);
            $statement->bindValue(':city', $city);
            $statement->bindValue(':province', $province);
            $statement->bindValue(':postalCode', $postalCode);
            $statement->bindValue(':countryCode', $countryCode);
            $statement->bindValue(':phone', $phone);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':password', $password);

            $statement->execute();
            $statement->closeCursor();
        }

        $url = "index.php";
        header("Location: " . $url);
        die();
?>