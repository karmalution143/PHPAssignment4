<?php
  require_once('../model/database.php');

  $product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);

  switch (true) {
    case ($product_id != false):
      
      $query = 'DELETE FROM products
                WHERE productID = :product_id';

      $statement = $db->prepare($query);
      $statement->bindValue(':product_id', $product_id);

      $statement-> execute();
      $statement-> closeCursor();

  break;

  default:
  break;
}

    $url = "index.php";
      header("Location: " . $url);
      die();
?>