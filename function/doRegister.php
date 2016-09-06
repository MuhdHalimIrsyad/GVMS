<?php

if(count($_POST)>0) {
	include 'function/users.php';
	
	$errorArray = array();
	$photoFormatAllowed = array('gif', 'png', 'jpg');
	$photoFileName = $_FILES['photo']['name'];
	$photoExt = pathinfo($photoFileName, PATHINFO_EXTENSION);
	$photo = "NULL";
	
	/*
	if(isset($_POST['linkedInUrl']) && !empty($_POST['linkedInUrl']) && !preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$_POST['linkedInUrl'])) {
		array_push($errorArray, "Please enter a valid URL.");
	}
	*/
		
	
	if (isset($_POST['areaOfInterest']) && !empty($_POST['areaOfInterest'])) {
					
					$areaOfInterest = array();
					//foreach ($_POST['areaOfInterest'] as $selectedOption => $value)
					
							//array_push($areaOfInterest, $selectedOption);
	}
				
	if (is_uploaded_file($_FILES['photo']['tmp_name'])) {
		if (!in_array($photoExt,$photoFormatAllowed)) {
			array_push($errorArray, "Only gif, png, jpg allowed for photo.");
		}else {
			$photo = $_FILES['photo'];
		}	
	}
	
	$resumeFormatAllowed = array('doc', 'docx', 'pdf');
	$resumeFileName = $_FILES['resume']['name'];
	$resumeExt = pathinfo($resumeFileName, PATHINFO_EXTENSION);
	
	if (is_uploaded_file($_FILES['resume']['tmp_name'])) {
	
		if (!in_array($resumeExt,$resumeFormatAllowed)) {
			array_push($errorArray, "Only doc, docx, pdf allowed for resume.");
		}else {
			$resume = $_FILES['resume'];
		}
	}
	
	if (empty($_POST) === false) {
		$requiredFields = array("email", "password", "cfmPassword", "firstName", "lastName");
		foreach($_POST as $key=>$value) {
				if (empty($value) && in_array($key, $requiredFields) === true) {
						array_push($errorArray,"Fields marked with an asterisk are required.");
						break 1;
				}
		}
		if (isset($_POST['referral']) && !empty($_POST['referral']) && checkUserId($_POST['referral']) == 0) {
			array_push($errorArray,"Referral ID does not exist.");
		}
		if (strlen($_POST['password']) < 6) {
			array_push($errorArray,"Password must be more than 6 character!");
		}elseif (strcmp($_POST['cfmPassword'], $_POST['password']) != 0) {
			array_push($errorArray,"Password and retype password is not the same.");
		}

		$options = array(
			'options' => array('min_range' => 0)
		);
		if (isset($_POST['contactNo']) && !empty($_POST['contactNo']) && filter_var($_POST['contactNo'], FILTER_VALIDATE_INT, $options) === FALSE) {
			array_push($errorArray,"Please enter a valid contact number.");
		}

		if (empty($errorArray) === true) {
			if (emailExists($_POST['email']) != -1) {
				array_push($errorArray,"Sorry, the email address " . $_POST['email'] . " is already in used.");
			}else {
				$dob = "NULL";
				$resume = "NULL";
				$linkedIn = "NULL";
				$contactNo = "NULL";
				$referralID = "NULL";
				$occupation = "NULL";
				$bio = "NULL";
				$areaOfInterest = "";
				
				if (isset($_POST['dob']) && !empty($_POST['dob'])) {
					$dob = str_replace('/', '-', $_POST['dob']);
					$dob = "'" . date('Y-m-d', strtotime($dob)) . "'";
				}
				if (isset($_POST['occupation']) && !empty($_POST['occupation'])) {
					$occupation = "'" . $_POST['occupation'] . "'";
				}
				if (isset($_POST['biography']) && !empty($_POST['biography'])) {
					$bio = "'" . $_POST['biography'] . "'";
				}
				if (isset($_POST['contactNo']) && !empty($_POST['contactNo'])) {
					$contactNo = "'" . $_POST['contactNo'] . "'";
				}
				if (isset($_POST['linkedInUrl']) && !empty($_POST['linkedInUrl'])) {
					$linkedIn = "'" . $_POST['linkedInUrl'] . "'";
				}
				if (isset($_POST['referral']) && !empty($_POST['referral'])) {
					$referralID = $_POST['referral'];
				}

				if (isset($_POST['areaOfInterest']) && !empty($_POST['areaOfInterest'])) {
					$areaOfInterest = array();
					foreach ($_POST['areaOfInterest'] as $selectedOption)
						array_push($areaOfInterest, $selectedOption);
				}
					
				if (createVolunteer($_POST['firstName'], $_POST['lastName'], $dob, $_POST['email'], $_POST['password'], $photo, $occupation, $bio, $areaOfInterest, $resume, $linkedIn, $contactNo, $referralID) ==true) {
					header("Location: login.php");
				}else {
					array_push($errorArray, "Error! Please try again.");
				}
			}
		}
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

	