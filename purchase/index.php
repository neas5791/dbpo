<?php $thispage='purchase'; ?>
<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	date_default_timezone_set('Australia/Sydney');
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

	if (isset($_POST['detail'])) {
		if ($_POST['po_number'] == '' || $_POST['supplier'] == '') {
				header('Location: ./?add=1&invalid=4&po_number='.$_POST['po_number']
					.'&supplier='.$_POST['supplier'].'&po_date='.$_POST['po_date'] );
				exit();
		}

		// validate data prior to submission
		if( !isset($_POST['po_number']) && !isset($_POST['supplier'])){
			$error = 'not enough details.';
			include $_SERVER['DOCUMENT_ROOT'].'/includes/error.html.php';
			exit();
		}

			$error = 'Add Detail executed.';
			include $_SERVER['DOCUMENT_ROOT'].'/includes/error.html.php';
			exit();
	}

	// launch add form
	if (isset($_GET['add'])) {

		include $_SERVER['DOCUMENT_ROOT'].'/includes/db.inc.php';

		$pagetitle = 'New Order';
		$action = 'addform';
		$id = '';
		
		if (isset($_GET['invalid'])) {
			$po_number = $_GET['po_number'];
			$po_date = $_GET['po_date'];

			if ($_GET['supplier']	=='')
				$sup = 0;
			else
				$sup = $_GET['supplier'];
		}
		else {
			$po_number = '';
			$po_date = date('d-m-Y');
			$sup = 0;
		}

		$button = 'New order';

		try {
			$supplier_results = $pdo->query("SELECT id, company FROM tbSupplier");
			// $partnumber_results = $pdo->query("SELECT id, partnumber FROM tbPart ORDER BY partnumber");
			// $status_results = $pdo -> query("SELECT id, status FROM tbStatus ORDER BY status");
		}
		catch (PDOException $e) {
			$error = 'Error fetching supplier list.';
			include $_SERVER['DOCUMENT_ROOT'].'/includes/error.html.php';
			exit();
		}

		foreach ($supplier_results as $row){
			$suppliers [] = array(
					'id' => $row['id'],
					'company' => $row['company'] ); 
		}
		
		// foreach ($partnumber_results as $row){
		// 	$partnumbers [] = array(
		// 			'id' => $row['id'],
		// 			'partnumber' => $row['partnumber'] ); 
		// }

		// foreach ($status_results as $row ) {
		// 	$stats [] = array(
		// 		'id' => $row['id'],
		// 		'status' => $row['status'] );
		// }

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


	// ****************  Pagination ********************************//
	// http://www.tutorialspoint.com/php/mysql_paging_php.htm ******//
	include $_SERVER['DOCUMENT_ROOT'] .
			'/includes/db.inc.php';

	$rec_limit = 25; // number records to display on page
	
	try {
		// number of records in table
		$sql = 'SELECT COUNT(id) FROM tbPurchaseOrder WHERE active';
		$s = $pdo ->prepare($sql);
		$s -> execute();
		$recval = $s -> fetch();
	}
	catch (PDOException $e) {
		$error = 'Error counting part results.<br>' . $e -> getMessage();
		include $_SERVER['DOCUMENT_ROOT'] .
			'/includes/error.html.php';
		exit();
	}
	$rec_count = $recval[0];

	// check that the table contains records
	if($rec_count == 0) { 
		$error = 'No valid data in table.<br>'.$sql;
		include $_SERVER['DOCUMENT_ROOT'] .
			'/includes/error.html.php';
		exit();	
	}

	if( isset($_GET['page'] ) ) {
		
		if ( $_GET['page'] < ($rec_count / $rec_limit)-1 )
			$page = $_GET['page'] + 1;
		else
			$page = $_GET['page'];

		$offset = $rec_limit * $page ;
  }
	else {
    $page = 0;
    $offset = 0;
  }

  $left_rec = $rec_count - ($page * $rec_limit);


 // Populate the list with server data
	try {
		$sql = 'SELECT 
					tbPurchaseOrder.po_date,
					tbPurchaseOrder.po_number,
					tbSupplier.company,
					tbPurchaseOrder.active
				FROM tbPurchaseOrder
				JOIN tbSupplier 
				ON tbPurchaseOrder.supplierid = tbSupplier.id
				ORDER BY tbPurchaseOrder.po_date DESC, tbPurchaseOrder.po_number DESC
				LIMIT :offset, :rec_limit;';
		$output =  $sql;
		$s = $pdo -> prepare($sql);
		$s -> bindValue(':offset', $offset,PDO::PARAM_INT);
		$s -> bindValue(':rec_limit', $rec_limit, PDO::PARAM_INT);		
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