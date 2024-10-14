<?php
session_start();
require_once('../model/database.php');

$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

if ($email) {

    $query = "SELECT customerID, firstName, lastName FROM customers WHERE email = :email";
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    
    $customer = $statement->fetch();
    $statement->closeCursor();

    if ($customer) {
        $_SESSION['customer_email'] = $email; 
        $_SESSION['customer_id'] = $customer['customerID'];
        $_SESSION['firstName'] = $customer['firstName'];
        $_SESSION['lastName'] = $customer['lastName'];
        
        header('Location: create_incident_form.php');
        exit();
    } else {
        $_SESSION['login_error'] = "Invalid email address.";
        header('Location: index.php');
        exit();
    }
    
} else {
    $_SESSION['login_error'] = "Email is required.";
    header('Location: index.php');
    exit();
}
?>
