<?php

    function getProject($projectID) {

        include 'function/dbConnection.php';
    
        $query = "SELECT * FROM project WHERE projectid = ".$projectID.";";
        
        $rs = pg_query($con, $query) or die (pg_last_error($con));
        
        $projectArray = [];
        
        while ($projectRow = pg_fetch_array($rs)) {
            $projectArray['name'] = $projectRow['name'];
            $projectArray['startdate'] = date("d/m/Y", strtotime($projectRow['startdate']));
            if (strtotime($projectRow['enddate']) == -1) {
                $projectArray['enddate'] = "-";
            } else {
                $projectArray['enddate'] = date("d/m/Y", strtotime($projectRow['enddate']));
            }
            $projectArray['repetition'] = $projectRow['repetition'];
            $projectArray['description'] = $projectRow['description'];
            $projectArray['visiblity'] = $projectRow['visiblity'];
            if ($projectRow['noofpersonnel'] == NULL) {
                $projectArray['noofpersonnel'] = 0;
            } else {
                $projectArray['noofpersonnel'] = $projectRow['noofpersonnel'];
            }
            $projectArray['status'] = $projectRow['status'];
        }
        
        return $projectArray;
    }
    
    function getProjectOwner($projectID) {
        
        include 'function/dbConnection.php';
        
        $query = "SELECT * FROM projectownership WHERE projectid = ".$projectID.";";
        
        $rs = pg_query($con, $query) or die (pg_last_error($con));
        
        $projectOwnerArray = [];
        
        while ($projectOwnerRow = pg_fetch_array($rs)) {
            array_push($projectOwnerArray, $projectOwnerRow['userid']);
        }
        
        return $projectOwnerArray;
        
    }
    
    function getProjectSkillID($projectID) {
        
        include 'function/dbConnection.php';
        
        $query = "SELECT skillid FROM projectSkillRequired WHERE projectid = ".$projectID.";";
        
        $rs = pg_query($con, $query) or die (pg_last_error($con));
        
        $projectSkillIDArray = [];
        
        while ($projectSkillIDRow = pg_fetch_array($rs)) {
            array_push($projectSkillIDArray, $projectSkillIDRow['skillid']);
        }
        
        return $projectSkillIDArray;
    }
    
    function getProjectSkillRequired($projectID) {
        
        include 'function/dbConnection.php';
        
        $query = "SELECT * FROM (SELECT psr.skillid FROM projectSkillRequired psr WHERE psr.projectid = ".$projectID.") AS projectSR, skillDefinition s WHERE"
                . " projectSR.skillid = s.skillid;";
        
        $rs = pg_query($con, $query) or die (pg_last_error($con));
        
        $projectSkillArray = [];
        
        while ($projectSkillRow = pg_fetch_array($rs)) {
            array_push($projectSkillArray, $projectSkillRow['name']);
        }
        
        return $projectSkillArray;
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
        
        include 'function/dbConnection.php';
        
        $query = "INSERT INTO volunteerApp(projectid, skillid, userid, appstatus, appdescription) VALUES (".$projectid.
                ", ".$skillid.", ".$userid.", 'Processing', '".$description."');";
        
        $rs = pg_query($con, $query) or die (pg_last_error($con));
        
        if ($rs) {
            return TRUE;
        }
        
        return FALSE;
        
    }
    
    function showProjectStatus($email, $projectid, $skillid) {
        
        include 'function/dbConnection.php';
        include 'function/users.php';
        
        $userid = emailExists($email);
        
        if ($userid != -1) {
            $query = "SELECT * FROM volunteerapp WHERE projectid = ".$projectid." AND skillid = ".$skillid." AND userid = ".$userid.";";
        
            $rs = pg_query($con, $query) or die (pg_last_error($con));
        
            $projectDetail = getProject($projectid);
            $projectOwner = getProjectOwner($projectid);
            $projectLocation = projectLocation($projectid);
        
            if (pg_num_rows($rs)) {
                //Redha, I don't know how you want to display. But this side is for volunteer who have applied for the project
            } else {
                //This side is for volunteer who have yet to register for the project
                $projectSkillID = getProjectSkillID($projectid);
                $projectSkill = getProjectSkillRequired($projectid);
            }
        }
        
        
    }
?>
