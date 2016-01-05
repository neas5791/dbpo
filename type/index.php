<?php $thispage='type'; ?>
<!-- https://github.com/spbooks/PHPMYSQL5/blob/master/chapter4/listjokes/jokes.html.php -->
<?php
	include_once $_SERVER['DOCUMENT_ROOT'].
		'/includes/magicquote.inc.php';
	include_once $_SERVER['DOCUMENT_ROOT'].
		'/includes/helper.inc.php';

	if (isset($_GET['invalid'])){
		$comment = errorMessage($_GET['invalid']);
	}
	// launch add form
	if (isset($_POST['add'])) {
		$pagetitle = 'New Type';
		$action = 'addform';
		$id = '';
		$status = '';
		$description = '';
		$button = 'Add type';

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
			$sql = 'SELECT id, type, description FROM tbType
					WHERE id = :id;';
			$s = $pdo -> prepare($sql);
			$s -> bindValue(':id', $_POST['select']);
			$s -> execute();
			$row = $s->fetch();

			$pagetitle = 'Edit Type';
			$action = 'editform';
			$id = $row['id'];
			$type = $row['type'];
			$description = $row['description'];
			$button = 'Update';
		}
		catch (PDOException $e) {
			$error = 'SQL Insert Query error.<br>'.
			$e -> getMessage();

			include $_SERVER['DOCUMENT_ROOT'] .
				'/includes/error.html.php';
			exit();
		}

		include $_SERVER['DOCUMENT_ROOT'].'/'.$thispage.'/form.html.php';
		exit();
	}
	// launch delete form
	if (isset($_POST['delete'])){
		
		if ($_POST['select'] <= 5) {
			header('Location: ./?invalid=1');
			exit();
		}

		include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php'; 

		try {
			$sql = 'SELECT id, type, description FROM tbType
					WHERE id = :id;';
			$s = $pdo -> prepare($sql);
			$s -> bindValue(':id', $_POST['select']);
			$s -> execute();
			$row = $s->fetch();

			$pagetitle = 'Delete Record';
			$action = 'deleteform';
			$id = $row['id'];
			$type = $row['type'];
			$description = $row['description'];
			$button = 'DELETE!';

			include $_SERVER['DOCUMENT_ROOT'].'/'.$thispage.'/form.html.php';
			exit();
		}
		catch (PDOException $e) {
			$error = 'SQL Insert Query error.<br>'.
			$e -> getMessage();

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

		if ($_POST['type'] == null && $_POST['description'] == null ){
			header('Location: ./?invalid=1');
			exit();
		}

		// Check that the type doesn't already exist
		try {
			$sql = 'SELECT COUNT(type) FROM tbType
					WHERE type = :type;';
			$s = $pdo -> prepare($sql);
			$s -> bindValue(':type', strtoupper($_POST['type']));
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
			$sql = 'INSERT INTO tbType SET 
						type = :type,
						description = :description';
			// create a prepared statment
			$s = $pdo->prepare($sql);
			// bind values
			$s->bindValue(':type', strtoupper($_POST['type']));
			$s->bindValue(':description', ucfirst(strtolower($_POST['description'])));
			$s->execute();
		}
		catch (PDOException $e) {
			$error = 'SQL Insert Query error.<br>'.
			$e->getMessage();

			include $_SERVER['DOCUMENT_ROOT'] .
				'/includes/error.html.php';

			exit();
		}

		header('Location: ./');

		exit();
	}
	// edit form action
	if (isset($_POST['editform'])) {

		if ($_POST['type'] == null && $_POST['description'] == null ){
			header('Location: ./');
			exit();
		}
		
		include $_SERVER['DOCUMENT_ROOT'] .
			'/includes/db.inc.php';

		try {
			$sql = 'UPDATE tbType SET
					type = :type,
					description = :description
					WHERE id = :id;';
			$s = $pdo -> prepare($sql);
			$s -> bindValue(':id', $_POST['id']);
			$s -> bindValue(':type', strtoupper($_POST['type']));
			$s -> bindValue(':description', ucfirst(strtolower($_POST['description'])));
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
			$sql = 'DELETE FROM tbType
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
	try {
		include $_SERVER['DOCUMENT_ROOT'] .
			'/includes/db.inc.php';

		$sql = 'SELECT id, type, description FROM tbType;';
		$output =  $sql;
		$s = $pdo -> prepare($sql);
		$s -> execute();
		$result = $s -> fetchAll();
	}
	catch (PDOException $e) {
		$error = 'Error fecthing jokes ' . $e->getMessage();
		include $_SERVER['DOCUMENT_ROOT'] .
				'/includes/error.html.php';
		exit();
	}

	include $_SERVER['DOCUMENT_ROOT'] . '/' . $thispage . '/type.html.php';
?>