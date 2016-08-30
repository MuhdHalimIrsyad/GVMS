<?php



function projectLocation($projectID) {
	
	$host = "localhost"; 
	$user = "postgres"; 
	$pass = "hometown"; 
	$db = "gamified"; 

	$con = pg_connect("host=$host dbname=$db user=$user password=$pass")
    or die ("Could not connect to server\n" . pg_last_error()); 
	
	$queryLocationID = 'SELECT "locationID" FROM projectLocation WHERE "projectID" = ' . $projectID;

	$rs = pg_query($con, $queryLocationID) or die (pg_last_error($con));
	
	$locationIDRow = pg_fetch_array($rs);
	
	while ($row = pg_fetch_array($rs)) {
		$queryLocation = 'SELECT * FROM location WHERE "locationID" = ' . $row["locationID"];
		
		$rs1 = pg_query($con, $queryLocation) or die (pg_last_error($con));
		$row = pg_fetch_array($rs1);
		pg_close($con);
		return $row;
	}
	pg_close($con); 	
	return false;
}
?>

