<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Supplier List</title>
    <link rel="stylesheet" type="text/css" href="../style_v20.css">
    <nav>
      <?php include $_SERVER['DOCUMENT_ROOT'].'/includes/navigation.inc.php'; ?>
    </nav>
  </head>
  <body>
    <form method="POST">
      <div class="wrapper'"> 
        <table class="database">
        <caption>Supplier List:</caption>
          <tr>
            <th scope="col"><!-- Select --></th>
            <th scope="col">Company</th>
            <th scope="col">Contact</th>
            <th scope="col">Address</th>
            <th scope="col">City</th>
            <th scope="col">State</th>
            
            <th scope="col">Country</th>
            <th scope="col">Zip</th>
            <th scope="col">Mobile</th>
            <th scope="col">Phone</th>
            <th scope="col">Fax</th>
            <th scope="col">Email</th>
            <th scope="col">WWW</th>
          </tr>
          <?php foreach ($result as $reading) : ?>
            <tr>
              <td center><input type="radio" name="select" value="<?php echo $reading['id']; ?>"></input></td>
              <td><?php echo $reading['company']; ?></td>
              <td><?php echo $reading['contact']; ?></td>
              <td><?php echo $reading['address1'].' '.$reading['address2']; ?></td>
              <td><?php echo $reading['city']; ?></td>
              <td><?php echo $reading['state']; ?></td>
              
              <td><?php echo $reading['country']; ?></td>
              <td><?php echo $reading['postcode']; ?></td>
              <td><?php echo $reading['mobile']; ?></td>                            
              <td><?php echo $reading['phone']; ?></td>
              <td><?php echo $reading['fax']; ?></td>
              <td><?php echo $reading['email']; ?></td>
              <td><?php echo $reading['www']; ?></td>
            </tr>
          <?php endforeach; ?>
        </table>
      </div> <!-- end wrapper -->
      <div class="controls">
        <input type="submit" name="add" value="Add">
        <input type="submit" name="edit" value="Edit">
        <input type="submit" name="delete" value="Delete">
      </div>
      <div class="message">
        <p style="color:red">
          <b>
            <?php
              echo $comment; 
            ?>
          </b>
        </p>
      </div>
    </form>
  </body>
</html>