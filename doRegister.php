<?php

if(count($_POST)>0) {
	include 'users.php';
	
	$errorArray = array();
	
	$photoFormatAllowed = array('gif', 'png', 'jpg');
	$photoFileName = $_FILES['photo']['tmp_name'];
	$photoExt = pathinfo($photoFileName, PATHINFO_EXTENSION);
	
	if (is_uploaded_file($_FILES['photo']['tmp_name']) && !in_array($photoExt,$photoFormatAllowed)) {
			array_push($errorArray, "Only gif, png, jpg allowed for photo.");
	}
	
	$resumeFormatAllowed = array('doc', 'docx', 'pdf');
	$resumeFileName = $_FILES['resume']['tmp_name'];
	$resumeExt = pathinfo($resumeFileName, PATHINFO_EXTENSION);
	
	if (is_uploaded_file($_FILES['resume']['tmp_name']) && !in_array($ext,$resumeFormatAllowed)) {
			array_push($errorArray, "Only doc, docx, pdf allowed for resume.");
	}
	
	if (empty($_POST) === false) {
		$requiredFields = array("email", "password", "cfmPassword", "firstName", "lastName");
		foreach($_POST as $key=>$value) {
				if (empty($value) && in_array($key, $requiredFields) === true) {
						array_push($errorArray,"Fields marked with an asterisk are required.");
						break 1;
				}
		}
		if (empty($errors) === true) {
				if (emailExists($_POST['email']) === true) {
					array_push($errorArray,"Sorry, the email address " . $_POST['email'] . " is already in used.");
				}
		}
	}
	
	if(isset($_POST['linkedInUrl']) && !empty($_POST['linkedInUrl']) && !filter_var($_POST['linkedInUrl'], FILTER_VALIDATE_URL) === true) {
		array_push($errorArray, "Please enter a valid URL.");
	}
	/**
	
	if(!isset($_POST['email']) || empty($_POST['email'])) {
		$pass = false;
	}
	
	if(!isset($_POST['firstName']) || empty($_POST['firstName'])) {
		$pass = false;
	}
	
	if(!isset($_POST['password']) || empty($_POST['password'])) {
		$pass = false;
	}
	
	if(!isset($_POST['cfmPassword']) || empty($_POST['cfmPassword'])) {
		$pass = false;
	}
	
	**/
	
	
	for ($x =0; $x < count($errorArray); $x++) {
			//header("Location: register.php");		
			//echo $x + 1 . ". " . $errorArray[$x] . "<br>";
			$warning .= $x + 1 . ". " . $errorArray[$x] . "<br>";
			//die();
	}
}
?>

	