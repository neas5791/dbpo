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
    <div id="pagination_ctl">
      <?php 
        if ( $left_rec < $rec_limit ) {
          $last = $page - 2;
          echo "<a href = \"?page=$last\">Last $rec_limit Records</a>";
        }
        else if ( $page == 0) {
          echo "<a href = \"?page=$page\">Next $rec_limit Records</a>"; 
        }
        else if( $page > 0) {
          $last = $page - 2;
          echo "<a href = \"?page=$last\">Last $rec_limit Records</a> |";
          echo "<a href = \"?page=$page\">Next $rec_limit Records</a>";
        } 
      ?>
     <!--  <select id="rec_limit">
        <option value=10  <?php if($rec_limit == 10 ) echo 'selected';?> >10</option>
        <option value=50  <?php if($rec_limit == 50 ) echo 'selected';?> >50</option>
        <option value=100 <?php if($rec_limit == 100) echo 'selected';?> >100</option>
      </select> -->
    </div>
    <form method="POST">
      <div class="wrapper'">
        <table class="database">
        <caption>Part List:</caption>
        <!-- <col align="center">
        <col align="center">
        <col align="Left"> -->
          <tr>
            <th scope="col"><!-- Select --></th>
            <th scope="col">Stock No</th>
            <th scope="col">Part No</th>
            <th scope="col">Drawing No</th>
            <th scope="col">Description</th>
            <th scope="col">Type</th>
          </tr>
          <?php foreach ($result as $reading) : ?>
            <tr>
              <td center><input type="radio" name="select" value="<?php echo $reading['id']; ?>"></input></td>
              <td><?php echo $reading['id']; ?></td>
              <td><?php echo $reading['partnumber']; ?></td>
              <td><?php echo $reading['drawingnumber']; ?></td>
              <td><?php echo $reading['description']; ?></td>
              <td><?php echo $reading['type']; ?></td>
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