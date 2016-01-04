<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Type List</title>
    <link rel="stylesheet" type="text/css" href="../style_v20.css">
    <nav>
      <?php include $_SERVER['DOCUMENT_ROOT'].'/includes/navigation.inc.php'; ?>
    </nav>
  </head>
  <body>
    <form method="POST">
    <div class="wrapper'">
      <table class="database">
      <caption>Type List:</caption>
      <!-- <col align="center">
      <col align="center">
      <col align="Left"> -->
        <tr>
          <th scope="col"><!-- Select --></th>
          <th scope="col">Type</th>
          <th scope="col">Description</th>
        </tr>
        <?php foreach ($result as $reading) : ?>
          <tr>
            <td center><input type="radio" name="select" value="<?php echo $reading['id']; ?>"></td>
            <td class="select"><?php echo $reading['type']; ?></td>
            <td><?php echo $reading['description']; ?></td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
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