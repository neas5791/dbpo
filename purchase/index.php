<?php $thispage='purchase'; ?>
<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
?>

<!-- https://github.com/spbooks/PHPMYSQL5/blob/master/chapter4/listjokes/jokes.html.php -->
<?php
	include_once $_SERVER['DOCUMENT_ROOT'].
		'/includes/magicquote.inc.php';
	include_once $_SERVER['DOCUMENT_ROOT'].
		'/includes/helper.inc.php';
	// output messages to html
	if (isset($_GET['invalid'])){
		$comment = errorMessage($_GET['invalid']);
	}

	// launch add form
	if (isset($_POST['add'])) {

		include $_SERVER['DOCUMENT_ROOT'].'/includes/db.inc.php';

		$pagetitle = 'New Order';
		$action = 'addform';
		$id = '';
		$po_number = '';
		$po_date = '';
		$button = 'New order';

		$reading = array('id' => '', 'line' => '', 'job' => '','partnumber' => '', 'qty' => '', 'price' => '', 'status' => '' );

		// print_r($reading);
		// exit();
		// 	$error = echo $reading['line'];
		// 	include $_SERVER['DOCUMENT_ROOT'].'/includes/error.html.php';
		// 	exit();


		try {
			$supplier_results = $pdo->query("SELECT id, company FROM tbSupplier");
			$partnumber_results = $pdo->query("SELECT id, partnumber FROM tbPart ORDER BY partnumber");
		}
		catch (PDOException $e) {
			$error = 'Error fetching supplier list.';
			include $_SERVER['DOCUMENT_ROOT'].'/includes/error.html.php';
			exit();
		}

		foreach ($supplier_results as $row){
			$suppliers [] = array(
					'id' => $row['id'],
					'company' => $row['company']); 
		}
		
		foreach ($partnumber_results as $row){
			$partnumbers [] = array(
					'id' => $row['id'],
					'partnumber' => $row['partnumber']); 
		}

		include $_SERVER['DOCUMENT_ROOT'] . '/' . $thispage . '/form.html.php';
		exit();
	}

	// // launch edit form
	// if (isset($_POST['edit'])){
	// 	// check that there is a selection
	// 	if ($_POST['select'] == 0) {
	// 		header('Location: ./?invalid=3');
	// 		exit();
	// 	}

	// 	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php'; 

	// 	try {
	// 		$sql = 'SELECT id, category, description FROM tbCategory
	// 				WHERE id = :id;';
	// 		$s = $pdo -> prepare($sql);
	// 		$s -> bindValue(':id', $_POST['select']);
	// 		$s -> execute();
	// 		$row = $s->fetch();

	// 		$pagetitle = 'Edit Category';
	// 		$action = 'editform';
	// 		$id = $row['id'];
	// 		$category = $row['category'];
	// 		$description = $row['description'];
	// 		$button = 'Update category';
	// 	}
	// 	catch (PDOException $e) {
	// 		$error = 'SQL Insert Query error.<br>'.
	// 		$e -> getMessage();

	// 		include $_SERVER['DOCUMENT_ROOT'] .
	// 			'/includes/error.html.php';
	// 		exit();
	// 	}

	// 	include $_SERVER['DOCUMENT_ROOT'].'/'.$thispage.'/form.html.php';
	// 	exit();
	// }
	// // launch delete form
	// if (isset($_POST['delete'])){
		
	// 	if ($_POST['select'] <= 4) {
	// 		header('Location: ./?invalid=1');
	// 		exit();
	// 	}
		
	// 	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php'; 

	// 	try {
	// 		$sql = 'SELECT 
	// 							tbPurchaseOrder.po_date, 
	// 							tbPurchaseOrder.po_number,
 //  							tbSupplier.company,
 //  							tbPurchaseOrder.active
	// 						FROM tbPurchaseLine
	// 						JOIN tbSupplier ON  tbPurchaseOrder.supplierid = tbSupplier.id
	// 						WHERE tbPurchaseOrder.id = :id;';


	// 		$s = $pdo -> prepare($sql);
	// 		$s -> bindValue(':id', $_POST['select']);
	// 		$s -> execute();
	// 		$row = $s->fetch();

	// 		$pagetitle = 'Delete Record';
	// 		$action = 'deleteform';
	// 		$id = $row['id'];
	// 		$category = $row['category'];
	// 		$description = $row['description'];
	// 		$button = 'DELETE!';

	// 		include $_SERVER['DOCUMENT_ROOT'].'/'.$thispage.'/form.html.php';
	// 		exit();
	// 	}
	// 	catch (PDOException $e) {
	// 		$error = 'SQL Insert Query error.<br>'.
	// 		$e -> getMessage();

	// 		include $_SERVER['DOCUMENT_ROOT'] .
	// 			'/includes/error.html.php';
	// 		exit();
	// 	}
		
	// 	include $_SERVER['DOCUMENT_ROOT'].'/'.$thispage.'/form.html.php';
	// 	exit();
	// }

	// add form action
	// if (isset($_POST['addform'])) {

	// 	include $_SERVER['DOCUMENT_ROOT'] .
	// 		'/includes/db.inc.php';

	// 	// ensure valid data has been entered
	// 	if ( $_POST['po_number'] == null || $_POST['po_date'] == null || $_POST['supplier'] == null  ){
	// 		header('Location: ./');
	// 		exit();
	// 	}

	// 	try {
	// 		$sql = 'SELECT COUNT(po_number) FROM tbPurchaseOrder
	// 				WHERE po_number = :po_number;';
	// 		$s = $pdo -> prepare($sql);
	// 		$s -> bindValue(':po_number', text($_POST['po_number'], 'u'));
	// 		$s -> execute();
	// 		$result = $s->fetchAll();

	// 		if ($result[0][0] > 0){
	// 			header('Location: ./?invalid=2');
	// 			exit();
	// 		}
	// 	}
	// 	catch (PDOException $e) {
	// 		$error = 'SQL Insert Query error.<br>'.
	// 		$e -> getMessage();

	// 		include $_SERVER['DOCUMENT_ROOT'] .
	// 			'/includes/error.html.php';
	// 		exit();
	// 	}

	// 	// run insert query
	// 	try {
	// 		$sql = 'INSERT INTO tbPurchaseOrder SET 
	// 					po_number = :po_number,
	// 					po_date = :po_date,
	// 					supplier = :supplier';
	// 		// create a prepared statment
	// 		$s = $pdo->prepare($sql);
	// 		// bind values
	// 		$s -> bindValue(':po_number', text($_POST['po_number'], 'u'));
	// 		$s -> bindValue(':po_date', $_POST['po_date'])));
	// 		$s -> bindValue(':supplier', $_POST['suplier']);
	// 		$s -> execute();
	// 	}
	// 	catch (PDOException $e) {
	// 		$error = 'SQL Insert Query error.<br>'.
	// 		$e -> getMessage();

	// 		include $_SERVER['DOCUMENT_ROOT'] .
	// 			'/includes/error.html.php';
			
	// 		exit();
	// 	}

	// 	header('Location: ./');
		
	// 	exit();
	// }

	// // edit form action
	// if (isset($_POST['editform'])) {

	// 	if ($_POST['category'] == null && $_POST['description'] == null ){
	// 		header('Location: ./?invalid=4');
	// 		exit();
	// 	}
		
	// 	include $_SERVER['DOCUMENT_ROOT'] .
	// 		'/includes/db.inc.php';

	// 	try {
	// 		$sql = 'UPDATE tbCategory SET
	// 				category = :category,
	// 				description = :description
	// 				WHERE id = :id;';
	// 		$s = $pdo -> prepare($sql);
	// 		$s -> bindValue(':id', $_POST['id']);
	// 		$s -> bindValue(':category', strtoupper($_POST['category']));
	// 		$s -> bindValue(':description', ucfirst(strtolower($_POST['description'])));
	// 		$s -> execute();
	// 	}
	// 	catch (PDOException $e) {
	// 		$error = 'SQL Update Query error.<br>'.
	// 		$e -> getMessage();

	// 		include $_SERVER['DOCUMENT_ROOT'] .
	// 			'/includes/error.html.php';
	// 		exit();
	// 	}

	// 	header('Location: ./');
		
	// 	exit();		
	// }
	// delete form action
	// if (isset($_POST['deleteform'])) {
		
	// 	include $_SERVER['DOCUMENT_ROOT'] .
	// 		'/includes/db.inc.php';

	// 	try {
	// 		$sql = 'UPDATE tbPurchaseOrder SET
	// 				active = FALSE,
	// 				WHERE id = :id;';
	// 		$s = $pdo -> prepare($sql);
	// 		$s -> bindValue(':id', $_POST['id']);
	// 		$s -> execute();
	// 	}
	// 	catch (PDOException $e) {
	// 		$error = 'SQL Update Query error.<br>'.
	// 		$e -> getMessage();

	// 		include $_SERVER['DOCUMENT_ROOT'] .
	// 			'/includes/error.html.php';
	// 		exit();
	// 	}

	// 	header('Location: ./');
		
	// 	exit();		
	// }
	// // Populate the list with server data
	try {
		include $_SERVER['DOCUMENT_ROOT'] .
			'/includes/db.inc.php';

		try {
			$results = $pdo -> query('SELECT COUNT(partnumber) FROM tbPart');

			print_r($results);
			exit();
		}
		catch (PDOException $e) {
			$error = 'Error counting part results.<br>' . $e -> getMessage();
			include $_SERVER['DOCUMENT_ROOT'] .
				'/includes/error.html.php';
			exit();
		}
		// $sql = 'SELECT 
		// 					tbPurchaseOrder.po_date, 
		// 					tbPurchaseOrder.po_number,
  // 						tbSupplier.company,
  // 						tbPurchaseOrder.active
		// 		FROM tbPurchaseLine
		// 		JOIN tbSupplier ON  tbPurchaseOrder.supplierid = tbSupplier.id
		// 		WHERE tbPurchaseOrder.active = TRUE;';

		$sql = 'SELECT 
					tbPurchaseOrder.po_date,
					tbPurchaseOrder.po_number,
					tbSupplier.company,
					tbPurchaseOrder.active
				FROM tbPurchaseOrder
				JOIN tbSupplier ON tbPurchaseOrder.supplierid = tbSupplier.id;
				';
		$output =  $sql;
		$s = $pdo -> prepare($sql);		
		$s -> execute();
		$result = $s -> fetchAll();
	}
	catch (PDOException $e) {
		$error = 'Error fecthing results with the following comment:<br>' . $e->getMessage();
		include $_SERVER['DOCUMENT_ROOT'] .
			'/includes/error.html.php';
		exit();
	}

	include $_SERVER['DOCUMENT_ROOT'] . '/' . $thispage . '/purchase.html.php';
?>