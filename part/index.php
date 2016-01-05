<?php $thispage='part'; ?>
<!-- https://github.com/spbooks/PHPMYSQL5/blob/master/chapter4/listjokes/jokes.html.php -->
<?php
	$comment = '';
	
	error_reporting(E_ALL);
	ini_set('display_errors', 'on');

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

		// list product types for combo box
		try {
			include $_SERVER['DOCUMENT_ROOT'] .
				'/includes/db.inc.php';
			$sql = 'SELECT id, type	FROM tbType;';
			$s = $pdo -> prepare($sql);
			$s -> execute();
			$types = $s -> fetchAll();
		}
		catch (PDOException $e) {
			$error = 'Error fecthing results with the following comment:<br>' . $e->getMessage();
			include $_SERVER['DOCUMENT_ROOT'] .
				'/includes/error.html.php';
			exit();
		}
		// get next Stock No
		try {
			include $_SERVER['DOCUMENT_ROOT'] .
				'/includes/db.inc.php';
			$sql = 'SHOW TABLE STATUS LIKE \'tbPart\';';
			$s = $pdo -> prepare($sql);
			$s -> execute();
			$row = $s -> fetch();
			$nextid = $row['Auto_increment'];
		}
		catch (PDOException $e) {
			$error = 'Error fecthing results with the following comment:<br>' . $e->getMessage();
			include $_SERVER['DOCUMENT_ROOT'] .
				'/includes/error.html.php';
			exit();
		}
		$pagetitle = 'New Category';
		$action = 'addform';
		$id = $nextid;
		$partnumber = '';
		$description = '';
		$drawingnumber = '';
		$typeid = 0;
		$button = 'Add part';

		include $_SERVER['DOCUMENT_ROOT'] . '/' . $thispage . '/form.html.php';
		exit();
	}
	// launch edit form
	if (isset($_POST['edit'])){
		// check that there is a selection
		if ($_POST['select'] == 0) {
			header('Location: ./?invalid=3');
			exit();
		}

		include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php'; 

		try {
			$sql = 'SELECT id, partnumber, description, drawingnumber, typeid FROM tbPart
					WHERE id = :id;';
			$s = $pdo -> prepare($sql);
			$s -> bindValue(':id', $_POST['select']);
			$s -> execute();
			$row = $s->fetch();

			$pagetitle = 'Edit Part';
			$action = 'editform';
			$id = $row['id'];
			$partnumber = $row['partnumber'];
			$description = $row['description'];
			$drawingnumber = $row['drawingnumber'];
			$typeid = $row['typeid'];
			$button = 'Update';
		}
		catch (PDOException $e) {
			$error = 'SQL Insert Query error.<br>'.
			$e -> getMessage();

			include $_SERVER['DOCUMENT_ROOT'] .
				'/includes/error.html.php';
			exit();
		}
		// list product types for combo box
		try {
			include $_SERVER['DOCUMENT_ROOT'] .
				'/includes/db.inc.php';
			$sql = 'SELECT id, type	FROM tbType;';
			$s = $pdo -> prepare($sql);
			$s -> execute();
			$types = $s -> fetchAll();
		}
		catch (PDOException $e) {
			$error = 'Error fecthing results with the following comment:<br>' . $e->getMessage();
			include $_SERVER['DOCUMENT_ROOT'] .
				'/includes/error.html.php';
			exit();
		}

		include $_SERVER['DOCUMENT_ROOT'].'/'.$thispage.'/form.html.php';
		exit();
	}
	// launch delete form
	if (isset($_POST['delete'])){
		// check that there is a selection
		if ($_POST['select'] == 0) {
			header('Location: ./?invalid=3');
			exit();
		}

		include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php'; 

		try {
			$sql = 'SELECT id, partnumber, description, drawingnumber, typeid FROM tbPart
					WHERE id = :id;';
			$s = $pdo -> prepare($sql);
			$s -> bindValue(':id', $_POST['select']);
			$s -> execute();
			$row = $s->fetch();

			$pagetitle = 'Delete Record';
			$action = 'deleteform';
			$id = $row['id'];
			$partnumber = $row['partnumber'];
			$description = $row['description'];
			$drawingnumber = $row['drawingnumber'];
			$typeid = $row['typeid'];
			$button = 'Delete';

		}
		catch (PDOException $e) {
			$error = 'SQL Insert Query error.<br>'.
			$e -> getMessage();

			include $_SERVER['DOCUMENT_ROOT'] .
				'/includes/error.html.php';
			exit();
		}

		// list product types for combo box
		try {
			include $_SERVER['DOCUMENT_ROOT'] .
				'/includes/db.inc.php';
			$sql = 'SELECT id, type	FROM tbType;';
			$s = $pdo -> prepare($sql);
			$s -> execute();
			$types = $s -> fetchAll();
		}
		catch (PDOException $e) {
			$error = 'Error fecthing results with the following comment:<br>' . $e->getMessage();
			include $_SERVER['DOCUMENT_ROOT'] .
				'/includes/error.html.php';
			exit();
		}

		include $_SERVER['DOCUMENT_ROOT'].'/'.$thispage.'/form.html.php';
		exit();
	}
	// add form action
	if (isset($_POST['addform'])) {

		include $_SERVER['DOCUMENT_ROOT'] .
			'/includes/db.inc.php';

		$partnumber = $_POST['partnumber'];


		if ($_POST['partnumber'] == null ) {
			if ($_POST['drawingnumber'] == null) {
				header('Location: ./?invalid=4');
				exit();
			}
			else {
				// set part number to be drawing number if no part number
				// has been entered.
				$partnumber = text($_POST['drawingnumber'],'u');
			}
		}

		try {
			$sql = 'SELECT COUNT(partnumber) FROM tbPart
					WHERE partnumber = :partnumber;';
			$s = $pdo -> prepare($sql);
			$s -> bindValue(':partnumber', text($partnumber, 'u'));
			$s -> execute();
			$result = $s->fetchAll();

			if ($result[0][0] > 0){
				header('Location: ./?invalid=2');
				exit();
			}
		}
		catch (PDOException $e) {
			$error = 'SQL Insert Query error.<br>'.
			$e -> getMessage();

			include $_SERVER['DOCUMENT_ROOT'] .
				'/includes/error.html.php';
			exit();
		}
		// run insert query
		try {
			$sql = 'INSERT INTO tbPart SET 
						partnumber = :partnumber,
						description = :description,
						drawingnumber = :drawingnumber, 
						typeid = :type';
			// create a prepared statment
			$s = $pdo->prepare($sql);
			// bind values
			$s -> bindValue(':partnumber', text( $partnumber, 'u'));
			$s -> bindValue(':description', text($_POST['description'], 's'));
			$s -> bindValue(':drawingnumber', text($_POST['drawingnumber'], 'u'));
			$s -> bindValue(':type', $_POST['type']);
			$s->execute();
		}
		catch (PDOException $e) {
			$error = 'SQL Insert Query error.<br>'.
			$e -> getMessage();

			include $_SERVER['DOCUMENT_ROOT'] .
				'/includes/error.html.php';
			
			exit();
		}

		header('Location: ./');
		
		exit();
	}
	// edit form action
	if (isset($_POST['editform'])) {

		$partnumber = $_POST['partnumber'];


		if ($_POST['partnumber'] == '' ) {
			if ($_POST['drawingnumber'] == '') {
				header('Location: ./?invalid=4');
				exit();
			}
			else {
				// set part number to be drawing number if no part number
				// has been entered.
				$partnumber = text($_POST['drawingnumber'],'u');
			}
		}
		
		include $_SERVER['DOCUMENT_ROOT'] .
			'/includes/db.inc.php';

		try {
			$sql = 'UPDATE tbPart SET
					partnumber = :partnumber,
					description = :description,
					drawingnumber = :drawingnumber,
					typeid = :type
					WHERE id = :id;';
			$s = $pdo -> prepare($sql);
			$s -> bindValue(':id', $_POST['id']);
			$s -> bindValue(':partnumber', text($partnumber, 'u'));
			$s -> bindValue(':description', text($_POST['description'], 's'));
			$s -> bindValue(':drawingnumber', text($_POST['drawingnumber'], 'u'));
			$s -> bindValue(':type', $_POST['type']);
			$s -> execute();
		}
		catch (PDOException $e) {
			$error = 'SQL Update Query error.<br>'.
			$e -> getMessage();

			include $_SERVER['DOCUMENT_ROOT'] .
				'/includes/error.html.php';
			exit();
		}

		header('Location: ./');
		
		exit();
	}
	// delete form action
	if (isset($_POST['deleteform'])) {
		
		include $_SERVER['DOCUMENT_ROOT'] .
			'/includes/db.inc.php';

		try {
			$sql = 'UPDATE tbPart SET
							active = FALSE
							WHERE id = :id;';
			$s = $pdo -> prepare($sql);
			$s -> bindValue(':id', $_POST['id']);
			$s -> execute();
		}
		catch (PDOException $e) {
			$error = 'SQL Update Query error.<br>'.
			$e -> getMessage();

			include $_SERVER['DOCUMENT_ROOT'] .
				'/includes/error.html.php';
			exit();
		}

		header('Location: ./');
		
		exit();		
	}
	// Populate the list with server data

	include $_SERVER['DOCUMENT_ROOT'] .
			'/includes/db.inc.php';
	
	// ****************  Pagination ********************************//
	$rec_limit = 25; // number records to display on page
	try {
		// number of records in table
		$sql = 'SELECT COUNT(partnumber) FROM tbPart WHERE active';
		
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

	try {
		$sql = 'SELECT 
					tbPart.id, 
					tbPart.partnumber, 
					tbPart.description, 
					tbPart.drawingnumber, 
					tbType.type 
				FROM tbPart 
				INNER JOIN tbType 
				ON tbPart.typeid = tbType.id
				WHERE tbPart.active
				ORDER BY tbPart.id
				LIMIT :offset, :rec_limit;';
		$s = $pdo -> prepare($sql);
		$s -> bindValue(':offset', $offset,PDO::PARAM_INT);
		$s -> bindValue(':rec_limit', $rec_limit, PDO::PARAM_INT);
		$s -> execute();
		$result = $s -> fetchAll();
	}
	catch (PDOException $e) {
		$error = 'Error fecthing part detail results with the following comment:<br>' . 
							$e->getMessage().'<br><br>'.$sql;
		include $_SERVER['DOCUMENT_ROOT'] .
			'/includes/error.html.php';
		exit();
	}

	include $_SERVER['DOCUMENT_ROOT'] . '/' . $thispage . '/part.html.php';
?>

		<!-- $error = 'mmmm';
		include $_SERVER['DOCUMENT_ROOT'] .
		'/includes/error.html.php';
		exit(); -->