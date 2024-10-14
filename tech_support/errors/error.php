<?php 
session_start();
include '../view/header.php'; 
$error = isset($_SESSION["add_error"]) ? $_SESSION["add_error"] : '';
unset($_SESSION["add_error"]);
?>
<main>
    <h1>Error</h1>
    <p><?php echo $error; ?></p>
</main>
<?php include '../view/footer.php'; ?>