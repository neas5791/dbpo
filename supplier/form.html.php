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
				<div><label for="company">Company:</label>
					<input type="text" name="company" id="company" value="<?php htmlout($company);?>">
				</div>
				<div><label for="contact">Contact:</label>
					<input type="text" name="contact" id="contact" value="<?php htmlout($contact);?>">
				</div>
				<div><label for="address">Address:</label>
					<textarea row="2" name="address" id="address"><?php htmlout($address1);echo "\n";htmlout($address2); 
							?>
					</textarea>
				</div>
				<div><label for="city">City:</label>
					<input type="text" name="city" id="city" value="<?php htmlout($city);?>">
				</div>
				<div><label for="state">State:</label>
					<input type="text" name="state" id="state" value="<?php htmlout($state);?>">
				</div>
				<div><label for="postcode">Postcode:</label>
					<input type="text" name="postcode" id="postcode" value="<?php htmlout($postcode);?>">
				</div>
				<div><label for="country">Country:</label>
					<input type="text" name="country" id="country" value="<?php htmlout($country);?>">
				</div>
				<div><label for="mobile">Mobile:</label>
					<input type="text" name="mobile" id="mobile" value="<?php htmlout($mobile);?>">
				</div>
				<div><label for="phone">Phone:</label>
					<input type="text" name="phone" id="phone" value="<?php htmlout($phone);?>">
				</div>
				<div><label for="fax">Fax:</label>
					<input type="text" name="fax" id="fax" value="<?php htmlout($fax);?>">
				</div>
				<div><label for="email">Email:</label>
					<input type="text" name="email" id="email" value="<?php htmlout($email);?>">
				</div>
				<div><label for="www">www:</label>
					<input type="text" name="www" id="www" value="<?php htmlout($www);?>">
				</div>
				<div><input type="submit" name="<?php htmlout($action);?>" value="<?php htmlout($button);?>"></div>
				<div><input type="submit" name="cancel" value="Cancel"></div>
			</form>
		</div>
	</body>
</html>