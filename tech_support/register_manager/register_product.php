<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

$productCode = filter_input(INPUT_POST, 'productID');
$customerID=$_SESSION['customer_id'];
$email=$_SESSION['customer_email'];

require_once('../model/database.php');

$registrationDate = date('Y-m-d');

$queryCheck = 'SELECT * FROM registrations WHERE customerID = :customerID AND productCode = :productCode';
$checkStatement = $db->prepare($queryCheck);
$checkStatement->bindValue(':customerID', $customerID);
$checkStatement->bindValue(':productCode', $productCode);
$checkStatement->execute();
$existingEntry = $checkStatement->fetch();
$checkStatement->closeCursor();

if ($existingEntry) {
    // Set an error message in the session and redirect
    $_SESSION['error_message'] = "This product is already registered by this customer.";
    header('Location: register_product_form.php'); // Redirect to the registration form
    exit();
}

$queryInsert = 'INSERT INTO registrations (customerID, email, productCode, registrationDate)
                VALUES (:customerID, :email, :productCode, :registrationDate)';
$statement = $db->prepare($queryInsert);
$statement->bindValue(':customerID', $customerID);
$statement->bindValue(':email', $email);
$statement->bindValue(':productCode', $productCode);
$statement->bindValue(':registrationDate', $registrationDate);
$statement->execute();
$statement->closeCursor();

header('Location: register_success.php');
exit();
?>