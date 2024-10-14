<?php
    require_once('../model/database.php');

    $customerID = filter_input(INPUT_POST, 'customerID', FILTER_VALIDATE_INT);

    $query = 'SELECT * FROM customers WHERE customerID = :customerID';
    $statement = $db->prepare($query);
    $statement->bindValue(':customerID', $customerID);
    $statement->execute();
    $customer = $statement->fetch();
    $statement->closeCursor();

    $queryCountries = 'SELECT * FROM countries';
    $statementCountries = $db->prepare($queryCountries);
    $statementCountries->execute();
    $countries = $statementCountries->fetchAll();
    $statementCountries->closeCursor();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" type="text/css" href="../main.css" />
      <title>Customer Manager</title>
  </head>
  <body>
      <?php include("../view/header.php"); ?>
      
      <main>
        <h2>View / Update Customer</h2>

        <form action="update_customer.php" method="post" id="add_customer_form">
        <div id="data">

          <input type = "hidden" name = "customerID"
            value = "<?php echo $customer['customerID']; ?>" />

          <label>First Name:</label>
          <input type="text" name="firstName"
            value = "<?php echo $customer['firstName']; ?>" /><br />

          <label>Last Name:</label>
          <input type="text" name="lastName"
            value = "<?php echo $customer['lastName']; ?>" /><br />

          <label>Address:</label>
          <input type="text" name="address"
            value = "<?php echo $customer['address']; ?>" /><br />

          <label>City:</label>
          <input type="text" name="city" 
            value = "<?php echo $customer['city']; ?>" /><br />
        

          <label>Province:</label>
          <input type="text" name="province"
            value = "<?php echo $customer['province']; ?>" /><br />

          <label>Postal Code:</label>
          <input type="text" name="postalCode"
            value = "<?php echo $customer['postalCode']; ?>" /><br />

          <label>Country:</label>
          <select name="countryCode">
            <?php foreach ($countries as $country) : ?>
            <option value="<?php echo $country['countryCode']; ?>"
            <?php if ($country['countryCode'] == $customer['countryCode']) echo 'selected'; ?>>
            <?php echo $country['countryCode']; ?>
            </option>
            <?php endforeach; ?>
            </select><br />

          <label>Phone:</label>
          <input type="text" name="phone"
          value = "<?php echo $customer['phone']; ?>" /><br/>

          <label>Email:</label>
          <input type="text" name="email"
          value = "<?php echo $customer['email']; ?>" /><br/>

          <label>Password:</label>
          <input type="text" name="password"
          value = "<?php echo $customer['password']; ?>" /><br/>
        
          </div>
        
        <div id="buttons">
          <label>&nbsp;</label>
          <input type="submit" value="Save Customer" /><br/>
        </div>

        </form>
        
        <p><a href="index.php">View Customer List</a></p>
      </main>

      <?php include("../view/footer.php"); ?>
  </body>
</html>