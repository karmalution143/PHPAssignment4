<?php
    require('../model/database.php');

    $queryTechnicians = 'SELECT * FROM technicians';
    $statement1 = $db->prepare($queryTechnicians);
    $statement1->execute();
    $technicians = $statement1->fetchAll();
    $statement1->closeCursor();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../main.css" />
    <title>Technicians</title>
</head>
<body>
    <?php include("../view/header.php"); ?> 
    <main>
      <h2>Technicians</h2>
      <table>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>&nbsp;</th> <!-- for delete button -->
        </tr>
        <?php foreach ($technicians as $tech): ?>
        <tr>
            <td><?php echo $tech['firstName']; ?></td>
            <td><?php echo $tech['lastName']; ?></td>
            <td><?php echo $tech['email']; ?></td>
            <td><?php echo $tech['phone']; ?></td>
            <td>
                <form action="delete_tech.php" method="post">
                    <input type="hidden" name="tech_id"
                    value="<?php echo $tech['techID']; ?>" />
                    <input type="submit" value="Delete" />
                </form>
            </td>
        </tr>
        <?php endforeach; ?>  
      </table>
      <p><a href="add_tech_form.php">Add Technician</a></p>
    </main>

    <?php include("../view/footer.php"); ?>
</body>
</html>