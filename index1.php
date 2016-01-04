<!-- https://github.com/spbooks/PHPMYSQL5/blob/master/chapter4/listjokes/jokes.html.php -->
<?php
	// fixes magic quotes problems
	if (get_magic_quotes_gpc())
	{
	  $process = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);
	  while (list($key, $val) = each($process))
	  {
	    foreach ($val as $k => $v)
	    {
	      unset($process[$key][$k]);
	      if (is_array($v))
	      {
	        $process[$key][stripslashes($k)] = $v;
	        $process[] = &$process[$key][stripslashes($k)];
	      }
	      else
	      {
	        $process[$key][stripslashes($k)] = stripslashes($v);
	      }
	    }
	  }
	  unset($process);
	}
	if (isset($_GET['addType'])) {
		include 'form.html.php';
		exit();
	}
	// connect to mysql database
	try	{
		$pdo = new PDO('mysql:host=localhost;dbname=dbPurchase', 'pouser', 'mypassword');
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec('SET NAMES "utf8"');
	}
	catch (PDOException $e) {
		$output = 'Unable to connect to the database server.<br>'.
		$e->getMessage();
		include 'error.html.php';
		exit();
	}
	$output = 'Database connection successful';
	// include 'output.html.php';
	if (isset($_POST['Type'])) {
		if ($_POST['Type'] == null && $_POST['Description'] == null ){
			header('Location: .');
			exit();
		}
		// run insert query
		try {
			$sql = 'INSERT INTO tbType SET 
						Type = :type,
						Description = :description';
			// create a prepared statment
			$s = $pdo->prepare($sql);
			// bind values
			$s->bindValue(':type', $_POST['Type'], PDO::PARAM_INT);
			$s->bindValue(':description', $_POST['Description'], PDO::PARAM_INT);
			$s->execute();
		}
		catch (PDOException $e) {
			$output = 'SQL Insert Query error.<br>'.
			$e->getMessage();
			include 'error.html.php';
			exit();
		}
		header('Location: .');
		exit();
	}
	try {
		$sql = 'SELECT Type, Description FROM tbType;';
		$output =  $sql;
		// include 'output.html.php';
		$s = $pdo->prepare($sql);
		$s->execute();
		$result = $s->fetchAll();
	}
	catch (PDOException $e) {
		$output = 'Error fecthing jokes ' . $e->getMessage();
		include 'error.html.php';
		exit();
	}
	$output =  'Got result set';
	include 'index.html.php';
	// header('Location: .');
?>
