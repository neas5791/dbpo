<?php
	try	{
		$pdo = new PDO('mysql:host=localhost;dbname=dbPO', 'pouser', 'mypassword');
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec('SET NAMES "utf8"');
	}
	catch (PDOException $e) {
		$error = 'Unable to connect to the database server.<br>'.
		$e->getMessage();
		include $_SERVER['DOCUMENT_ROOT'].'/includes/error.html.php';
		exit();
	}

	$output = 'Database connection successful';
?>