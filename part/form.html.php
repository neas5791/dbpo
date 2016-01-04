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

			<form method="POST">
				<div>
					<input type="hidden" name="id" value="<?php htmlout($id);?>">
				</div>
				<div><label for="stocknumber">Stock No:</label>
					<input type="text" name="stocknumber" id="stocknumber" value="<?php htmlout($id); ?>" disabled>
				</div>
				<div><label for="partnumber">Part No:</label>
					<input type="text" name="partnumber" value="<?php htmlout($partnumber);?>" <?php if($action == 'deleteform' ) { echo "disabled";};?>>
				</div>
				<div><label for="description">Description:</label>
					<input type="text" name="description" value="<?php htmlout($description);?>"<?php if($action == 'deleteform') { echo "disabled";};?>>
				</div>
				<div><label for="drawingnumber">Drawing No:</label>
					<input type="text" name="drawingnumber" id="drawingnumber" value="<?php htmlout($drawingnumber);?>"<?php if($action == 'deleteform') { echo "disabled";};?>>
				</div>
				<div>
					<label for="type">Type:</label>
					<select name="type" id="type">
						<option value="0"></option>
						<?php foreach ($types as $type): ?>
							<option name="type" value="<?php htmlout($type['id']); ?>" <?php if ($type['id'] == $typeid) {echo 'selected="selected"';} ?>><?php htmlout($type['type']);?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div><input type="submit" name="<?php htmlout($action);?>" value="<?php htmlout($button);?>"></div>
				<div><input type="submit" name="cancel" value="Cancel"></div>
			</form>
		</div>
	</body>
</html>