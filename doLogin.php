<?php
include 'users.php';

$errorArray = array();
if(count($_POST)>0) {
	
	if (empty($_POST) === false) {
		$requiredFields = array("email", "password");
		foreach($_POST as $key=>$value) {
				if (empty($value) && in_array($key, $requiredFields) === true) {
						array_push($errorArray,"Fields marked with an asterisk are required.");
						break 1;
				}
		}
	}
	
	if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password'])
		&& !empty($_POST['password'])) {
	
		if (emailExists($_POST['email']) > 0) {
			if (checkPassword($_POST['email'], $_POST['password']) == 1) {
				$_SESSION['email'] = $_POST['email'];
				$_SESSION['logged']='yes';
				
				header("Location: search.php");
			}else {
				array_push($errorArray,"Email or password invalid.");
			}	
		}else {
			array_push($errorArray,"Email or password invalid.");
		}
	}
	
	if(!isset($_POST['firstName']) || empty($_POST['firstName'])) {
		$pass = false;
	}
	
	if(!isset($_POST['password']) || empty($_POST['password'])) {
		$pass = false;
	}
	
	for ($x =0; $x < count($errorArray); $x++) {
			$warning .= $x + 1 . ". " . $errorArray[$x] . "<br>";
	}
	
}

?>