<?php
session_start();
require_once('../model/database.php');

$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

if ($email) {

    $query = "SELECT customerID FROM customers WHERE email = :email";
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    
    $customer = $statement->fetch();
    $statement->closeCursor();

    if ($customer) {
        $_SESSION['customer_email'] = $email; // Set the session variable
        $_SESSION['customer_id'] = $customer['customerID']; // Store customer ID in session
        
        header('Location: register_product_form.php');
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
