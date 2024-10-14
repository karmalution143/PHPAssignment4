<?php
  session_start();
    if (isset($_SESSION['customer_email'])) {
      header("Location: register_product_form.php");
      exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../main.css" />
  <title>Customer Login</title>
</head>
<body>
  <?php include("../view/header.php"); ?>
    <main>
      
      <h2>Customer Login</h2>
      <p>You must login before you can register a product.</p><br>

      <form action="process_login.php" method="post">
          <label for="email">Email Address:</label>
          <input type="email" id="email" name="email" required>
          <input type="submit" value="Login">
      </form>

    </main>
  <?php include("../view/footer.php"); ?>
</body>
</html>