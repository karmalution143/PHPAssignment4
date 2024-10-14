<?php
    require('../model/database.php');

    $queryCustomers = 'SELECT * FROM customers';
    $statement1 = $db->prepare($queryCustomers);
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
    <title>Customers</title>
</head>
<body>
    <?php include("../view/header.php"); ?> 
    <main>
      <h2>Customers</h2>
      <table>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Address</th>
            <th>City</th>
            <th>Province</th>
            <th>Postal Code</th>
            <th>Country</th>
            <th>Phone</th>
            <th>Email</th>
            <th>&nbsp;</th> <!-- for delete button -->
        </tr>
        <?php foreach ($customers as $customer): ?>
        <tr>
            <td><?php echo $customer['firstName']; ?></td>
            <td><?php echo $customer['lastName']; ?></td>
            <td><?php echo $customer['address']; ?></td>
            <td><?php echo $customer['city']; ?></td>
            <td><?php echo $customer['province']; ?></td>
            <td><?php echo $customer['postalCode']; ?></td>
            <td><?php echo $customer['countryCode']; ?></td>
            <td><?php echo $customer['phone']; ?></td>
            <td><?php echo $customer['email']; ?></td>
            <td>
                <form action="delete_customer.php" method="post">
                    <input type="hidden" name="customer_id"
                    value="<?php echo $customer['customerID']; ?>" />
                    <input type="submit" value="Delete" />
                </form>
            </td>
        </tr>
        <?php endforeach; ?>  
      </table>
    </main>

    <?php include("../view/footer.php"); ?>
</body>
</html>