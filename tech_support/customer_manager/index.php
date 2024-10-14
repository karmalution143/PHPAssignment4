<?php
    require('../model/database.php');

    $queryCustomers = 'SELECT * FROM customers';
    $statement1 = $db->prepare($queryCustomers);
    
    
    // Check if the search form is submitted
    $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);

    switch (true) {
        case ($lastName):
      $queryCustomers = 'SELECT * FROM customers WHERE lastName = :lastName';
      $statement1 = $db->prepare($queryCustomers);
      $statement1->bindValue(':lastName', $lastName);
    break;

    default:
      $queryCustomers = 'SELECT * FROM customers';
      $statement1 = $db->prepare($queryCustomers);
    }

    $statement1->execute();
    $customers = $statement1->fetchAll();
    $statement1->closeCursor();
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../main.css" />
    <title>Customer List</title>
</head>
<body>
    <?php include("../view/header.php"); ?> 
    <main>
      <h2>Customer Search</h2>

      <form action="" method="post">
          <input type="text" name="lastName" placeholder="Enter last name" required />
          <input type="submit" value="Search" />
      </form>
      <table>
        <tr>
        <h2>Results</h2>
            <th>Last Name</th>
            <th>City</th>
            <th>Email</th>
            <th>&nbsp;</th> <!-- for select button -->
        </tr>
        <?php foreach ($customers as $customer): ?>
        <tr>
            <td><?php echo $customer['lastName']; ?></td>
            <td><?php echo $customer['city']; ?></td>
            <td><?php echo $customer['email']; ?></td>
            <td>
                <form action="update_customer_form.php" method="post">
                    <input type="hidden" name="customerID"
                    value="<?php echo $customer['customerID']; ?>" />
                    <input type="submit" value="Select" />
                </form>
            </td>    
         </tr>
        <?php endforeach; ?>  
      </table>
            <form action="index.php" method="get">
                <input type="submit" value="Search Customers" />
            </form>
    </main>

    <?php include("../view/footer.php"); ?>
</body>
</html>