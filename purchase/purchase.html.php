<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Status List</title>
    <link rel="stylesheet" type="text/css" href="../style_v20.css">
    <nav>
      <?php include $_SERVER['DOCUMENT_ROOT'].'/includes/navigation.inc.php'; ?>
    </nav>  
  </head>
  <body>
    <form method="POST">
      <div class="wrapper'">
        <table class="database">
        <caption>Purchase Orders:</caption>
          <tr>
            <th scope="col"><!-- Select --></th>
            <th scope="col">Date</th>
            <th scope="col">Purchase Order</th>
            <th scope="col">Supplier</th>

            <!-- <th scope="col">Line</th>
            <th scope="col">Job No</th>
            <th scope="col">Part Number</th>
            <th scope="col">Quantity</th>
            <th scope="col">Unit Price</th>
            <th scope="col">Line Total</th> -->
            <th scope="col">Status</th>
          </tr>

          <?php foreach ($result as $reading) : ?>
            <tr>
              <td center><input type="radio" name="select" value="<?php echo $reading['id']; ?>"></input></td>
              <td><?php echo $reading['po_date']; ?></td>
              <td><?php echo $reading['po_number']; ?></td>
              <td><?php echo $reading['company']; ?></td>
<!--               <td class="select"><?php echo $reading['line']; ?></td>
              <td class="select"><?php echo $reading['job']; ?></td>
              <td><?php echo $reading['partnumber']; ?></td>
              <td><?php echo $reading['qty']; ?></td>
              <td><?php echo $reading['price']; ?></td>
              <td><?php echo $reading['cost']; ?></td> -->
              <td class="select">
                <?php if ($reading['active']) : ?>
                  <?php echo 'ACTIVE'; ?>
                <?php else : ?>
                  <?php echo 'CLOSED'; ?>
                <?php endif; ?>
              </td>
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
              if (isset($comment)) echo $comment; 
            ?>
          </b>
        </p>
      </div>
    </form>
  </body>
</html>