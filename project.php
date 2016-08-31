<?php

    function getProject($projectID) {

        include 'dbConnection.php';
    
        $query = "SELECT * FROM project WHERE projectid = ".$projectID.";";
        
        $rs = pg_query($con, $query) or die (pg_last_error($con));
        
        $projectArray = [];
        
        while ($projectRow = pg_fetch_array($rs)) {
            $projectArray['name'] = $projectRow['name'];
            $projectArray['startDate'] = date("d/m/Y", strtotime($projectRow['startDate']));
            if (strtotime($projectRow['endDate']) == -1) {
                $projectArray['endDate'] = "-";
            } else {
                $projectArray['endDate'] = date("d/m/Y", strtotime($projectRow['endDate']));
            }
            $projectArray['repetition'] = $projectRow['repetition'];
            $projectArray['description'] = $projectRow['description'];
            $projectArray['visibility'] = $projectRow['visibility'];
            if ($projectRow['noofpersonnel'] == NULL) {
                $projectArray['noofpersonnel'] = 0;
            } else {
                $projectArray['noofpersonnel'] = $eventRow['noofpersonnel'];
            }
            $projectArray['status'] = $eventRow['status'];
        }
        
        return $projectArray;
    }
    
    function getProjectOwner($projectID) {
        
        include 'dbConnection.php';
        
        $query = "SELECT * FROM projectOwnership WHERE projectid = ".$projectID.";";
        
        $rs = pg_query($con, $query) or die (pg_last_error($con));
        
        $projectOwnerArray = [];
        
        while ($projectOwnerRow = pg_fetch_array($rs)) {
            array_push($projectOwnerArray, $projectOwnerRow['userid']);
        }
        
        return $projectOwnerArray;
        
    }
    
    function getProjectSkillID($projectID) {
        
        include 'dbConnection.php';
        
        $query = "SELECT skillid FROM projectSkillRequired WHERE projectid = ".$projectID.";";
        
        $rs = pg_query($con, $query) or die (pg_last_error($con));
        
        $projectSkillIDArray = [];
        
        while ($projectSkillIDRow = pg_fetch_array($rs)) {
            array_push($projectSkillIDArray, $projectSkillIDRow['skillid']);
        }
        
        return $projectSkillIDArray;
    }
    
    function getProjectSkillRequired($projectID) {
        
        include 'dbConnection.php';
        
        $query = "SELECT s.name AS skillName FROM (SELECT psr.skillid FROM projectSkillRequired psr WHERE psr.projectid = ".$projectID.") AS projectSR, skillDefinition s WHERE"
                . " projectSR.skillid = s.skillid;";
        
        $rs = pg_query($con, $query) or die (pg_last_error($con));
        
        $projectSkillArray = [];
        
        while ($projectSkillRow = pg_fetch_array($rs)) {
            array_push($projectSkillArray, $projectSkillRow['skillName']);
        }
    }

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
    
    function projectApplication($projectid, $skillid, $userid, $description) {
        
        include 'dbConnection.php';
        
        $query = "INSERT INTO volunteerApp(projectid, skillid, userid, appstatus, appdescription) VALUES (".$projectid.
                ", ".$skillid.", ".$userid.", 'Processing', ".$description.");";
        
        $rs = pg_query($con, $query) or die (pg_last_error($con));
        
        if ($rs) {
            return TRUE;
        }
        
        return FALSE;
        
    }
?>

