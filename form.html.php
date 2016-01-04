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
				<div><label for="Type">Type Code:</label>
					<input type="text" name="Type" id="type">
				</div>
				<div><label for="Description">Description:</label>
					<input type="text" name="Description" id="description">
				</div>
				<div><a class="submit" href="javascript:{}" onclick="document.getElementById('insert').submit();">Submit</a></div>
				<!-- <div><input type="submit" value="ADD" id="button"></div> -->
			</form>
		</div>
	</body>
</html>