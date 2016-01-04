<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Add New Part Type</title>
		<link rel="stylesheet" type="text/css" href="style.css"></li>
	</head>
	<body>
		<div class="wrapper">
			<form action="?" method="post" id="insert">
				<div><label for="Company">Company:</label>
					<input type="text" name="Company" id="company">
				</div>
				<div><label for="Contact">Contact:</label>
					<input type="text" name="Contact" id="contact">
				</div>
				<div><label for="Address">Address:</label>
					<textarea row="2" name="Address" id="address"></textarea>
					<!-- <input type="text" name="Address" id="address"> -->
				</div>
				<div><label for="City">City:</label>
					<input type="text" name="City" id="city">
				</div>
				<div><label for="State">State:</label>
					<input type="text" name="State" id="state">
				</div>
				<div><label for="Postcode">Postcode:</label>
					<input type="text" name="Postcode" id="postcode">
				</div>
				<div><label for="Country">Country:</label>
					<input type="text" name="Country" id="country">
				</div>
				<div><label for="Phone">Phone:</label>
					<input type="text" name="Phone" id="phone">
				</div>
				<div><label for="Fax">Fax:</label>
					<input type="text" name="Fax" id="fax">
				</div>
				<div><label for="Email">Email:</label>
					<input type="text" name="Email" id="email">
				</div>
				<div><label for="WWW">www:</label>
					<input type="text" name="WWW" id="www">
				</div>
				<div><a class="submit" href="javascript:{}" onclick="document.getElementById('insert').submit();">Submit</a></div>
				<!-- <div><input type="submit" value="ADD" id="button"></div> -->
			</form>
		</div>
	</body>
</html>