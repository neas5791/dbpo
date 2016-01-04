
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Control Panel</title>
    <link rel="stylesheet" type="text/css" href="style_v20.css">
    <nav>
      <?php 
        include $_SERVER['DOCUMENT_ROOT'].
          '/includes/navigation.inc.php'; 
      ?>
    </nav>
  </head>
 
  <body>
    <div class="wrapper'">
      
     <!--  <div class="content">
        <?php 
          if ( isset( $_GET['status'] ) ) 
            include 'status/index.php';
          if ( isset( $_GET['type'] ) ) 
            include 'type/index.php';
          if ( isset( $_GET['part'] ) ) 
            include 'part/index.php';
          if ( isset( $_GET['supplier'] ) ) 
            include 'supplier/index.php';
          if ( isset( $_GET['purchase'] ) ) 
            include 'purcahse/index.php';
          if ( isset( $_GET['home'] ) ) 
            include 'index.php';
            //header('Location: /status');
           ?>
      </div> <!-- div content --> 
    </div> <!-- div wrapper -->

  </body>
</html>