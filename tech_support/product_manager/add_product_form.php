
<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" type="text/css" href="../main.css" />
      <title>Product Manager - Add Product</title>
  </head>
  <body>
      <?php include("../view/header.php"); ?>
      
      <main>
        <h2>Add Product</h2>

        <form action="add_product.php" method="post" id="add_product_form">
        <div id="data">
          <label>Code:</label>
          <input type="text" name="productCode" /><br />

          <label>Name:</label>
          <input type="text" name="name" /><br />

          <label>Version:</label>
          <input type="text" name="version" /><br />

          <label>Release Date:</label>
          <input type="text" name="releaseDate" /><br />
        
          </div>
        
        <div id="buttons">
          <label>&nbsp;</label>
          <input type="submit" value="Save Product" /><br />
        </div>

        </form>
        
        <p><a href="index.php">View Product List</a></p>
      </main>

      <?php include("../view/footer.php"); ?>
  </body>
</html>