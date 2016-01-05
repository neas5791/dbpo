<?php 
	include_once $_SERVER['DOCUMENT_ROOT'] . 
		'/includes/helper.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?php htmlout($pagetitle);?></title>
		<link rel="stylesheet" type="text/css" href="../style_v20.css"></li>
		<nav>
				<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/navigation.inc.php'; ?>
		</nav>
	</head>
	<body>
		<div class="wrapper">
			<h2><?php htmlout($pagetitle);?></h2>
			
			<?php 
				if ($action == 'deleteform') { 
					echo '<h2 style="color:red"> <b>ARE YOU SURE YOU WANT TO DELETE THIS RECORD?</b></h2>';
				}
			?>
			<form name="purchaseOrder" method="POST">
				<div><label for="po_date">Date</label>
				<input type="text" name="po_date" id="po_date" value="<?php echo $po_date; ?>"/>
				<!-- 					<br class="clear" /> --> 
				</div>
				<div><label for="po_number">Order Number</label>
				<input type="text" name="po_number" id="po_number" />
				<!-- 					<br class="clear" />  -->
				</div>

				<div>
					<label for="supplier">Supplier:</label>
					<select name="supplier" id="supplier">
						<option value=""></option>
						<?php foreach ($suppliers as $supplier): ?>
							<option value="<?php htmlout($supplier['id']); ?>"><?php htmlout($supplier['company']); ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<input type="submit" name="detail" value="Next">
				<input type="submit" name="cancel" value="Cancel" formaction=".">
			</form>

			<!-- <?php //include 'form.body.html.php'; ?> -->
			
			<!--  -->
	<!-- 		<form method="POST">
				<div>
					<input type="hidden" name="id" value="<?php htmlout($id);?>">
				</div>
				<div><label for="category">Part number:</label>
					<input type="text" name="partnumber" id="partnumber" value="<?php htmlout($partnumber);?>" <?php if($action == 'deleteform' || $action == 'editform') { echo "disabled";};?>>
				</div>
				<div><label for="description">Description:</label>
					<input type="text" name="description" id="description" value="<?php htmlout($description);?>"<?php if($action == 'deleteform') { echo "disabled";};?>>
				</div>
				<div><label for="drawingnumber">Drawing number:</label>
					<input type="text" name="drawingnumber" id="drawingnumber" value="<?php htmlout($drawingnumber);?>"<?php if($action == 'deleteform') { echo "disabled";};?>>
				</div>
				<div>
					<select name="type" id="type">
						<option value="">Select type</option>
						<?php foreach ($types as $type): ?>
							<option value="<?php htmlout($type['id']); ?>"><?php htmlout($type['type']); ?></option>
						<?php endforeach; ?>
					</select>
				</div>				
				<div><input type="submit" name="<?php htmlout($action);?>" value="<?php htmlout($button);?>"></div>
				<div><input type="submit" name="cancel" value="Cancel"></div>
			</form> -->
		</div>
	</body>
</html>