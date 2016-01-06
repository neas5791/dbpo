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
				<div style="display: inline"><label for="po_date">Date</label>
				<input type="date" name="po_date" id="po_date" value="<?php echo $po_date; ?>"/>
				<!-- 					<br class="clear" /> --> 
				</div>
				<div><label for="po_number">Order Number</label>
				<input type="text" name="po_number" id="po_number" value="<?php echo $po_number; ?>"/>
				<!-- 					<br class="clear" />  -->
				</div>

				<div>
					<label for="supplier">Supplier:</label>
					<select name="supplier" id="supplier">
						<option value="" <?php if($sup == 0) echo 'selected';?> ></option>
						<?php foreach ($suppliers as $supplier): ?>
							<option value="<?php htmlout($supplier['id']); ?>" <?php if(isset($sup) && $supplier['id'] == $sup) echo 'selected'; ?> ><?php htmlout($supplier['company']); ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<input type="submit" name="detail" value="Next">
				<input type="submit" name="cancel" value="Cancel" formaction=".">
				<div class="message">
        	<p style="color:red">
          	<b>
            	<?php
              	if(isset($comment)) 
              		echo $comment; 
            	?>
          	</b>
       		</p>
    		</div>
			</form>
		</div>
	</body>
</html>