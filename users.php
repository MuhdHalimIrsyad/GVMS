<?php
	


//$num_cols = pg_num_fields($rs);

function emailExists($email) {
	$host = "localhost"; 
	$user = "postgres"; 
	$pass = "hometown"; 
	$db = "gamified"; 

	$con = pg_connect("host=$host dbname=$db user=$user password=$pass")
    or die ("Could not connect to server\n" . pg_last_error()); 
	
	$query = 'SELECT * FROM users WHERE "emailAddress" = ' . "'" . $email . "'";

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
	
	$query = 'SELECT * FROM users WHERE "emailAddress" = ' . "'" . $email . "'";

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
?>