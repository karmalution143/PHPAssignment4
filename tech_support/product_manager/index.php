<?php
    require('../model/database.php');

    $queryProducts = 'SELECT * FROM products';
    $statement1 = $db->prepare($queryProducts);
    $statement1->execute();
    $products = $statement1->fetchAll();
    $statement1->closeCursor();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../main.css" />
    <title>Product List</title>
</head>
<body>
    <?php include("../view/header.php"); ?> 
    <main>
      <h2>Product List</h2>
      <table>
        <tr>
            <th>Code</th>
            <th>Name</th>
            <th>Version</th>
            <th>Release Date</th>
            <th>&nbsp;</th> <!-- for delete button -->
        </tr>
        <?php foreach ($products as $product): ?>
        <tr>
            <td><?php echo $product['productCode']; ?></td>
            <td><?php echo $product['name']; ?></td>
            <td><?php echo $product['version']; ?></td>
            <td><?php 
                    $releaseDate = new DateTime($product['releaseDate']);
                    echo $releaseDate->format('m-d-Y'); 
                ?>
            </td>
            <td>
                <form action="delete_product.php"
                    method="post">
                    <input type="hidden" name="product_id"
                    value="<?php echo $product['productID']; ?>" />
                    <input type="submit" value="Delete" />
                </form>
            </td>
        </tr>
        
        <?php endforeach; ?>
      </table>
      <p><a href="add_product_form.php">Add Product</a></p>
    </main>

    <?php include("../view/footer.php"); ?>
</body>
</html>
