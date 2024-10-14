<?php
session_start();

if (!isset($_SESSION['customer_email'])) {
  header('Location: index.php');
  exit();
}

require_once('../model/database.php');

// Check for error message in the session
$error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : '';
// Clear the error message after displaying it
unset($_SESSION['error_message']);


$queryProducts = 'SELECT * FROM products';
$statement = $db->prepare($queryProducts);
$statement->execute();
$products = $statement->fetchAll();
$statement->closeCursor();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../main.css" />
  <title>Product Registration</title>
</head>
<body>
  <?php include("../view/header.php"); ?>
    <main>
      <h2>Register Product</h2>
      <p>Customer: <?php echo $_SESSION['customer_email']; ?> </p> </br>

      <?php if ($error_message): ?>
            <div class="error"><?php echo $error_message; ?></div>
      <?php endif; ?> </br>
      
      <form action="register_product.php" method="post">
            <label for="product">Select Product: </label>
              
                <select name="productID" id="product" required>
                    <option value="">Select a Product</option>
                    <?php foreach ($products as $product) : ?>
                      <option value="<?php echo $product['productCode']; ?>">
                        <?php echo $product['name']?>
                      </option>
                    <?php endforeach; ?>
                </select> <br><br>

            <input type="submit" value="Register Product"/>
            
      </form>
      
      <form action="process_logout.php" method="post">
                <button type="submit">Logout</button>
      </form>

      <p><a href="../product_manager/index.php">View Product List</a></p>
    </main>
  <?php include("../view/footer.php"); ?>
</body>
</html>