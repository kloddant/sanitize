<?php

	function sanitize($data = NULL, $depth = 0) {

		//Prevent the function from being run more than once without specific input.
		global $sanitized;
		if ($data === NULL and $depth == 0) {
			if ($sanitized) {
				return;
			}
			else {
				$GLOBALS['sanitized'] = True;
			}
		}

		if ($depth < 0 or !is_int($depth)) {
			$depth = 0;
		}
		// Increment the depth
		$depth = $depth + 1;
		//Prevent infinite recursion in case something goes wrong.
		if ($depth > 10) {
			return;
		}

		//If no data parameter is given, then sanitize all possible user input.
		if ($data === NULL and $depth == 1) {
			if (isset($_GET)) {
				$_GET = sanitize($_GET, $depth);
			}
			if (isset($_POST)) {
				$_POST = sanitize($_POST, $depth);
			}
			if (isset($_COOKIE)) {
				$_COOKIE = sanitize($_COOKIE, $depth);
			}
			if (isset($_REQUEST)) {
				$_REQUEST = sanitize($_REQUEST, $depth);
			}
			if (isset($_FILES)) {
				$_FILES = sanitize($_FILES, $depth);
			}
		}

		$type = gettype($data);
		$output = NULL;
		if ($type === "boolean" and is_bool($data)) {
			if ($data) {
				$data = True;
			}
			else {
				$data = False;
			}
			$output = (bool) $data;
		}
		else if ($type === "integer" and is_int($data) and is_numeric($data)) {
			$data = intval($data);
			$data = filter_var($data, FILTER_SANITIZE_NUMBER_INT);
			$output = (int) $data;
		}
		else if ($type === "double" and is_float($data) and is_numeric($data)) {
			$data = filter_var($data, FILTER_SANITIZE_NUMBER_FLOAT);
			$output = (double) $data;
		}
		else if ($type === "string") {
			$data = trim($data);
			if (filter_var($data, FILTER_VALIDATE_EMAIL)) {
				// If $data is an email, leave it alone.
			}
			else {
				$data = stripslashes($data);
				$data = strip_tags($data);
				$data = htmlspecialchars($data);
				$data = filter_var($data, FILTER_SANITIZE_STRING);
				$data = addslashes($data);			
				$output = $data;
			}
		}
		else if ($type === "array" and is_array($data)) {
			foreach ($data as $key => $value) {
			   $data[$key] = sanitize($value, $depth);
			}
			$output = (array) $data;
		}
		else if ($type === "object" and is_object($data)) {
			foreach ($data as $key => $value) {
			   $data[$key] = sanitize($value, $depth);
			}
			$output = (object) $data;
		}
		else if ($type === "resource" and is_resource($data)) {
		}
		else if ($type === "NULL" and is_null($data)) {
		}
		else if ($type === "unknown type") {
		}
		return $output;
	}
	
?>
