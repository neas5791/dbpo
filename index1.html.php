<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Part Type List</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="wrapper'">
      <table class="database">
      <caption>Part Type List:</caption>
        <tr>
          <th scope="col">Type</th>
          <th scope="col">Description</th>
        </tr>
        <?php foreach ($result as $reading) : ?>
          <tr>
            <td><?php echo $reading['Type']; ?></td>
            <td><?php echo $reading['Description']; ?></td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
    <div>
      <p>
        <a class="get_insert_type_form" href="?addType">Add new type</a>
      </p>
    </div>
  </body>
</html>