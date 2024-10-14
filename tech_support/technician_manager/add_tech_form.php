
<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" type="text/css" href="../main.css" />
      <title>Technician Manager - Add Technician</title>
  </head>
  <body>
      <?php include("../view/header.php"); ?>
      
      <main>
        <h2>Add Technician</h2>

        <form action="add_tech.php" method="post" id="add_tech_form">
        <div id="data">
          <label>First Name:</label>
          <input type="text" name="firstName" /><br />

          <label>Last Name:</label>
          <input type="text" name="lastName" /><br />

          <label>Email:</label>
          <input type="text" name="email" /><br />

          <label>Phone:</label>
          <input type="text" name="phone" /><br />
        
          <label>Password:</label>
          <input type="text" name="password" /><br />
        
          </div>
        
        <div id="buttons">
          <label>&nbsp;</label>
          <input type="submit" value="Save Technician" /><br />
        </div>

        </form>
        
        <p><a href="index.php">View Technicians</a></p>
      </main>

      <?php include("../view/footer.php"); ?>
  </body>
</html>