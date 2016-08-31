<?php
	


//$num_cols = pg_num_fields($rs);

function emailExists($email) {
	$host = "localhost"; 
	$user = "postgres"; 
	$pass = "hometown"; 
	$db = "gamified"; 

	$con = pg_connect("host=$host dbname=$db user=$user password=$pass")
    or die ("Could not connect to server\n" . pg_last_error()); 
	
	$query = 'SELECT * FROM users WHERE emailaddress = ' . "'" . $email . "'";

	$rs = pg_query($con, $query) or die (pg_last_error($con));
	
	$num_rows = pg_num_rows($rs);
	pg_close($con); 
	
	return $num_rows;
}
	
function checkPassword($email, $password) {
	
	$host = "localhost"; 
	$user = "postgres"; 
	$pass = "hometown"; 
	$db = "gamified"; 

	$con = pg_connect("host=$host dbname=$db user=$user password=$pass")
    or die ("Could not connect to server\n" . pg_last_error()); 
	
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
	
	$host = "localhost"; 
	$user = "postgres"; 
	$pass = "hometown"; 
	$db = "gamified"; 

	$con = pg_connect("host=$host dbname=$db user=$user password=$pass")
    or die ("Could not connect to server\n" . pg_last_error()); 
	
	$query = "INSERT INTO users VALUES(DEFAULT, '" . $firstName . "', '" . $lastName . "', '" . $email . "', '" . password_hash($password, PASSWORD_BCRYPT) . "',DEFAULT,'"
	. "volunteer'," . "NULL) RETURNING userid";
	
	

	$rs = pg_query($con, $query) or die (pg_last_error($con));
	
	if ($rs) {
		while ($row = pg_fetch_array($rs)) {
			$new_id = $row['userid'];
		 
		$query2 = "INSERT INTO volunteer VALUES(" . $new_id . ", " . $dob . ", " . $photo . "," . $occupation . "," . $bio . ", '" . $resume . "', "
		. $linkedIn . ", " . $contactNo . "," . $referralID . ")";

		$rs2 = pg_query($con, $query2) or die (pg_last_error($con));
		
		if ($rs && $rs2) {
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