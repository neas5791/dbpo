<?php $thispage='supplier'; ?>
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
		$pagetitle = 'New Supplier';
		$action = 'addform';
		$id = '';
		$status = '';
		$description = '';
		$button = 'Add supplier';

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

		include $_SERVER['DOCUMENT_ROOT'] . 
			'/includes/db.inc.php'; 

		try {
			$sql = 'SELECT id, company, contact, address1, address2, city,
							state, postcode, country, mobile, phone,
							fax, email, www
					FROM tbSupplier
					WHERE id = :id;';
			$s = $pdo -> prepare($sql);
			$s -> bindValue(':id', $_POST['select']);
			$s -> execute();
			$row = $s->fetch();

			$pagetitle = 'Edit Status';
			$action = 'editform';
			$id = $row['id'];
			$company = $row['company'];
			$contact = $row['contact'];
			$address1 = $row['address1'];
			$address2 = $row['address2'];
			$city = $row['city'];
			$state = $row['state'];
			$postcode = $row['postcode'];
			$country = $row['country'];
			$mobile = $row['mobile'];
			$phone = $row['phone'];
			$fax = $row['fax'];
			$email = $row['email'];
			$www = $row['www'];
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
		
		// if ($_POST['select'] <= 4) {
		// 	header('Location: ./?invalid=1');
		// 	exit();
		// }

		include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php'; 

		try {
			$sql = 'SELECT 	id, company, contact, address1, address2,
											city, state, postcode, country, mobile,
											phone, fax, email, www
							FROM tbSupplier
							WHERE id = :id;';
			$s = $pdo -> prepare($sql);
			$s -> bindValue(':id', $_POST['select']);
			$s -> execute();
			$row = $s->fetch();

			$pagetitle = 'Delete Record';
			$action = 'deleteform';
			$id = $row['id'];
			$company = $row['company'];
			$contact = $row['contact'];
			$address1 = $row['address1'];
			$address2 = $row['address2'];
			$city = $row['city'];
			$state = $row['state'];
			$postcode = $row['postcode'];
			$country = $row['country'];
			$mobile = $row['mobile'];
			$phone = $row['phone'];
			$fax = $row['fax'];
			$email = $row['email'];
			$www = $row['www'];

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

		if ( ($_POST['company'] == null) || ($_POST['contact'] == null) ){
			header('Location: ./');
			exit();
		}

		// Split the address text area at crlf using regex
		$address = preg_split("/\r\n|[\r\n]/",$_POST['address']);
		

		// $address1 = $address[0];

		if (count($address) == 1) {
			$address1 = $address;
			$address2 = null;
		}
		else {
			$address1 = $address[0];
			$address2 = $address[1];
		}

		// loosely check if company already exists
		// code here

		// run insert query
		try {
			$sql = 'INSERT INTO tbSupplier SET 
						company = :company,
						contact = :contact,
						address1 = :address1,
						address2 = :address2,
						city = :city,
						state = :state,
						postcode = :postcode,
						country = :country,
						mobile = :mobile,
						phone = :phone,
						fax = :fax,
						email = :email,
						www = :www';
			// create a prepared statment
			$s = $pdo -> prepare($sql);
			 // bind values
			$s -> bindValue(':company', 	text($_POST['company'], 't') );
			$s -> bindValue(':contact', 	text($_POST['contact'], 't') );
			$s -> bindValue(':address1', 	text( $address1, 				't') );
			$s -> bindValue(':address2', 	text( $address2, 				't') );
			$s -> bindValue(':city', 			text($_POST['city'], 		't') );
			$s -> bindValue(':state', 		text($_POST['state'],		'u') );
			$s -> bindValue(':country', 	text($_POST['country'], 't') );
			$s -> bindValue(':email', 		text($_POST['email'], 	'l') );
			$s -> bindValue(':www', 			text($_POST['www'], 		'l') );			
			
			$s -> bindValue(':mobile', 		format_mobile($_POST['mobile'	]) );
			$s -> bindValue(':phone', 		format_phone($_POST	['phone'	]) );
			$s -> bindValue(':fax', 			format_phone($_POST	['fax'		]) );
			$s -> bindValue(':postcode', 	$_POST['postcode'] );

			$s -> execute();
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

		if ($_POST['company'] == null && $_POST['contact'] == null ){
			header('Location: ./?invalid=4');
			exit();
		}
		
		include $_SERVER['DOCUMENT_ROOT'] .
			'/includes/db.inc.php';

		// Split the address text area at crlf using regex
		$address = preg_split("/\r\n|[\r\n]/",$_POST['address']);
		$address1 = $address[0];

		if (count($address) == 1) {
			$address2 = null;
		}
		else {
			$address2 = $address[1];
		}

		try {
			$sql = 'UPDATE tbSupplier 
							SET
								company = :company,
								contact = :contact,
								address1 = :address1,
								address2 = :address2,
								city = :city,
								state = :state,
								postcode = :postcode,
								country = :country,
								mobile = :mobile,
								phone = :phone,
								fax = :fax,
								email = :email,
								www = :www
					WHERE id = :id;';
			$s = $pdo -> prepare($sql);
			$s -> bindValue(':id',$_POST['id']);
			$s -> bindValue(':company', text($_POST['company'], 't'));
			$s -> bindValue(':contact', text($_POST['contact'], 't'));
			$s -> bindValue(':address1', text( $address1, 't' ));
			$s -> bindValue(':address2', text( $address2, 't' ));
			$s -> bindValue(':city', text($_POST['city'], 't'));
			$s -> bindValue(':state', text($_POST['state'],'u'));
			$s -> bindValue(':postcode', $_POST['postcode']);
			$s -> bindValue(':country', text($_POST['country'], 't'));
			$s -> bindValue(':mobile', format_mobile($_POST['mobile']));
			$s -> bindValue(':phone', format_phone($_POST['phone']));
			$s -> bindValue(':fax', format_phone($_POST['fax']));
			$s -> bindValue(':email', text($_POST['email'],'l'));
			$s -> bindValue(':www', text($_POST['www'],'l'));
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
			$sql = 'DELETE FROM tbSupplier
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

	// ****************  Pagination ********************************//
	// http://www.tutorialspoint.com/php/mysql_paging_php.htm ******//
	include $_SERVER['DOCUMENT_ROOT'] .
			'/includes/db.inc.php';

	$rec_limit = 25; // number records to display on page
	
	try {
		// number of records in table
		$sql = 'SELECT COUNT(company) FROM tbSupplier WHERE active';
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
							tbSupplier.id, 
							tbSupplier.company, 
							tbSupplier.contact, 
							tbSupplier.address1, 
							tbSupplier.address2, 
							tbSupplier.city, 
							tbSupplier.state, 
							tbSupplier.postcode, 
							tbSupplier.country, 
							tbSupplier.mobile, 
							tbSupplier.phone, 
							tbSupplier.fax, 
							tbSupplier.email, 
							tbSupplier.www 
						FROM tbSupplier
						WHERE active
						ORDER BY company
						LIMIT :offset, :rec_limit;';
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
	
	include $_SERVER['DOCUMENT_ROOT'] . '/' . $thispage . '/supplier.html.php';
?>
	<!-- $ADDRESS_LINE_LENGTH = 30; -->
