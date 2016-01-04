<?php
	function html($text) {
		return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
	}

	function htmlout($text) {
		echo html($text);
	}

	function errorMessage($error) {
		switch ($error) {
			case '1':
				return 'This item cannot be deleted';
				break;
			case '2':
				return 'The record already existed, no changes made.';
				break;
			case '3':
				return 'Nothing selected.';
				break;
			case '4':
				return 'Invalid data. No changes made.';
				break;
			default:
				break;
		}
	}

	function text($string, $style){
		switch ($style) {
			case 's': // sentence case
				return trim(ucfirst(strtolower($string)));
				break;
			case 't': // title case
				return trim(ucwords(strtolower($string)));
				break;
			case 'u': //uppercase
				return trim(strtoupper($string));
				break;
			case 'l': //lowercase
				return trim(strtolower($string));
				break;
			default:
				break;
		}
	}

	function format_phone($phone) {
	  // note: making sure we have something
	  if(!isset($phone{3})) { return ''; }
	  // note: strip out everything but numbers 
	  $phone = preg_replace("/[^0-9]/", "", $phone);
	  $length = strlen($phone);
	  switch($length) {
		  case 8:
		    return preg_replace("/([0-9]{4})([0-9]{4})/", "$1 $2", $phone);
		  	break;
		  case 10:
		  	$n = preg_replace("/([0-9]{4})([0-9]{6})/", "$1", $phone);

		  	// $error = $n;//'1300 999 333';
		  	// include $_SERVER['DOCUMENT_ROOT'].'/includes/error.html.php';
		  	// exit();

		  	if ($n == '1300')
		  		return preg_replace("/([0-9]{4})([0-9]{3})([0-9]{3})/", "$1 $2 $3", $phone);
		  	else
		   		return preg_replace("/([0-9]{2})([0-9]{4})([0-9]{4})/", "($1) $2 $3", $phone);
		  	break;
		  case 12:
		  	return '+'.preg_replace("/([0-9]{2})([0-9]{2})([0-9]{4})([0-9]{4})/", "$1 ($2) $3 $4", $phone);
		  	break;
		  default:
		    return $phone;
		  	break;
	  }
	}
	 
	function format_mobile($phone) {
	  // note: making sure we have something
	  if(!isset($phone{3})) { return ''; }
	  // note: strip out everything but numbers 
	  $phone = preg_replace("/[^0-9]/", "", $phone);
	  $length = strlen($phone);
	  switch($length) {
		  case 10:
		   	return preg_replace("/([0-9]{4})([0-9]{3})([0-9]{3})/", "$1 $2 $3", $phone);
		  	break;
		  default:
		    return $phone;
		  	break;
		}
	}
?>