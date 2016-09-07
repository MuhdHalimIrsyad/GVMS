<?php

    function getProject($projectID) {

        include 'dbConnection.php';
    
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
        
        include 'dbConnection.php';
        
        $query = "SELECT * FROM projectownership WHERE projectid = ".$projectID.";";
        
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
        
        include 'dbConnection.php';
        
        $query = "INSERT INTO volunteerApp(projectid, skillid, userid, appstatus, appdescription) VALUES (".$projectid.
                ", ".$skillid.", ".$userid.", 'Processing', '".$description."');";
        
        $rs = pg_query($con, $query) or die (pg_last_error($con));
        
        if ($rs) {
            return TRUE;
        }
        
        return FALSE;
        
    }
    
    function displayProject($projectid) {
        
        include 'dbConnection.php';
        
        $projectArray = [];
        $projectArray['detail'] = getProject($projectid);
        $projectArray['owner'] = getProjectOwner($projectid);
        $projectArray['location'] = projectLocation($projectid);
        
        if ($_SESSION['userId'] != NULL) {
            $query = "SELECT * FROM volunteerapp WHERE projectid = ".$projectid." AND userid = ".$_SESSION['userId'].";";
            $rs = pg_query($con, $query) or die (pg_last_error($con));
            
            if (pg_num_rows($rs) != 0) {
                for ($i = 0; $i < pg_num_rows($rs); $i++) {
                    $row = pg_fetch_array($rs);
                    $skillNameQuery = "SELECT name FROM skillDefinition WHERE skillid = ".$row['skillid'].";";
                    $skillNameResult = pg_query($con, $skillNameQuery);
                    $projectArray['status'][$i]['skillname'] = pg_fetch_array($skillNameResult)['name'];
                    $projectArray['status'][$i]['appstatus'] = $row['appstatus'];
                }
            } else {
                $projectArray['skillId'] = getProjectSkillID($projectid);
                $projectArray['skillRequired'] = getProjectSkillRequired($projectid);
            }
        } 
        
        return $projectArray;
    }
    
  
?>

