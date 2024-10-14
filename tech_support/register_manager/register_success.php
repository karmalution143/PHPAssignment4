<?php
session_start();
require_once('../model/database.php');

$customerID = $_SESSION['customer_id'];

$query = 'SELECT * FROM registrations WHERE customerID = :customerID';
$statement = $db->prepare($query);
$statement->bindValue(':customerID', $customerID);
$statement->execute();
$registrations = $statement->fetchAll();
$statement->closeCursor();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<?php include("../view/header.php"); ?>
  <h2>The product has been successfully registered</h2>
  <table>
        <tr>
            <th>CustomerID</th>
            <th>Email</th>
            <th>ProductCode</th>
            <th>Registration Date</th>
        </tr>
        <?php foreach ($registrations as $registration): ?>
        <tr>
            <td><?php echo $registration['customerID']; ?></td>
            <td><?php echo $registration['email']; ?></td>
            <td><?php echo $registration['productCode']; ?></td>
            <td><?php echo $registration['registrationDate']; ?></td>
        </tr>
        <?php endforeach; ?>
  </table>
  <?php include("../view/footer.php"); ?>
</body>
</html>