<?php
//$num_cols = pg_num_fields($rs);

function emailExists($email) {
	include 'dbConnection.php'; 
	
	$query = 'SELECT * FROM users WHERE emailaddress = ' . "'" . $email . "'";

	$rs = pg_query($con, $query) or die (pg_last_error($con));
	
	$num_rows = pg_num_rows($rs);
	$result = pg_fetch_array($rs);
	$userId = $result['userid'];
	pg_close($con);
	if ($num_rows >0) {
		return $userId;
	}
	
	return -1;
}
	
function checkPassword($email, $password) {
	
	include 'dbConnection.php';
	
	$query = 'SELECT * FROM users WHERE emailaddress = ' . "'" . $email . "'";

	$rs = pg_query($con, $query) or die (pg_last_error($con));
	
	while ($row = pg_fetch_array($rs)) {
		pg_close($con);
		if (password_verify($password, $row['password']) == 1) {
			$_SESSION['firstName'] = $row['firstName'];
			$_SESSION['lastName'] = $row['lastName'];
			return true;
		}else{
			return false;
		}
	}	 
	return false;
}

function createVolunteer($firstName, $lastName, $dob, $email, $password, $photo, $occupation, $bio, $areaOfInterest, $resume, $linkedIn, $contactNo, $referralID) {
	
	include 'dbConnection.php';
	
	$query = "INSERT INTO users VALUES(DEFAULT, '" . $firstName . "', '" . $lastName . "', '" . $email . "', '" . password_hash($password, PASSWORD_BCRYPT) . "',DEFAULT,'"
	. "volunteer'," . "NULL) RETURNING userid";

	
	$rs = pg_query($con, $query) or die (pg_last_error($con));
	
	if ($rs) {
		while ($row = pg_fetch_array($rs)) {
			$new_id = $row['userid'];
		
			if (isset($_FILES['photo']) && !empty($_FILES['photo'])) {
				$photoUploadDir = "photo/" . $new_id . "/";
				$photoName = basename($_FILES['photo']['name']);
				$photoUploadFile = $photoUploadDir . $photoName;
				if(!is_dir($photoUploadDir)){
					mkdir($photoUploadDir, 0777);
				}
				if (move_uploaded_file($_FILES['photo']['tmp_name'], $photoUploadFile)) {
					$photo = "'" . $photoUploadFile . "'";
				}	
			}
			
			if (isset($_FILES['resume']) && !empty($_FILES['resume'])) {
				$resumeUploadDir = "resume/" . $new_id . "/";
				$resumeName = basename($_FILES['resume']['name']);
				$resumeUploadFile = $resumeUploadDir . $resumeName;
				if(!is_dir($resumeUploadDir)){
					mkdir($resumeUploadDir, 0777);
				}
				if (move_uploaded_file($_FILES['resume']['tmp_name'], $resumeUploadFile)) {
					$resume = "'" . $resumeUploadFile . "'";
				}	
			}
			
			$query2 = "INSERT INTO volunteer VALUES(" . $new_id . ", " . $dob . ", " . $occupation . "," . $bio . "," . $linkedIn . ", " . $contactNo . "," . $referralID . "," . $photo . "," . $resume . ")";
			
			
			$rs2 = pg_query($con, $query2) or die (pg_last_error($con));
			
			if (count($areaOfInterest) > 0) {
				foreach ($areaOfInterest as $selectedOption) {
					$query3 = "INSERT INTO userskillinterest VALUES(" . $new_id . "," . $selectedOption . ")";
					$rs3 = pg_query($con, $query3) or die (pg_last_error($con));
				}
			}
			
			if ($rs && $rs2 && $rs3) {
				return true;
			}else {
				pg_query("ROLLBACK") or die("Transaction rollback failed\n");
				return false;
			}
		
	}
	return false;
	}
}
?>